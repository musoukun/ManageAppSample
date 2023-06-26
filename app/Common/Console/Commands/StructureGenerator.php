<?php

declare(strict_types=1); // 強い型付けの設定

namespace App\Common\Console\Commands;

use Illuminate\Database\Eloquent\Collection as Collection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Commands StructureGenerator
 * 構造体をDBのテーブルから作成します。コメントに論理名は設定しておいてください。
 * --y が上書きオプションです。
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Request
 * @package App\Domain\{feature};
 */
class StructureGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "dev-generate {appName} {feature} {tableName} {--y}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $appName = $this->argument('appName'); //アプリ名
        $feature = $this->argument('feature'); //機能名
        $tableName = $this->argument('tableName'); //テーブル名

        // テーブル情報を取得
        $schema = DB::connection()->getDoctrineSchemaManager();
        $table = $schema->listTableDetails($tableName);

        // カラム情報を取得
        $columns = $table->getColumns();

        if ($columns != null) {
            $this->createEntity($appName, $feature, $tableName, $columns);
            $this->createRequest($appName, $feature, $tableName, $columns);
        } else {
            $this->comment("テーブルのデータがありません");
        }

        $this->comment("END");
    }



    /**
     * Entityの生成
     * @todo 型を記載予定
     * @var string
     */
    private function createEntity(String $appName, String $feature, String $tableName, array $columns)
    {

        $body = file_get_contents(
            app_path("Common/Console/Commands/resources/Entity.stub")
        );

        //とりあえずDefaultをreadonlyで宣言してるけど適宜変えてってください。
        $varPropertieTemplate = "/** @var {type} 項目：{logicalName} **/\n    public readonly ?{type} \${columnName};\n";
        $castTemplate = "'{columnName}' => '{type}'";
        $toEntityTemplate = "\$this->{columnName} = \$model->{logicalName};";
        $setterTemplate = "\$this->{columnName} = \$obj->{columnName};";
        $propertyTemplate = "* @property {type} {columnName}";

        //検索フォームに表示したいものの配列
        $varProperties = [];
        $casts = [];
        $toEntitys = [];
        $setters = [];
        $properties = [];

        foreach ($columns as $column) {

            // laravel用のカラムは覗く
            if (strpos($column->getName(), "_at") != false) {
                continue;
            }

            // それぞれのテンプレート読み込み

            $varPropertie = $varPropertieTemplate;
            //クラスの中のプロパティを記述
            $varPropertie = str_replace("{columnName}", $column->getName(), $varPropertie);
            $varPropertie = str_replace("{logicalName}", $column->getComment() ?? ' ', $varPropertie);
            $varPropertie = str_replace("{type}", $column->getType()->getName() ?? ' ', $varPropertie);
            array_push($varProperties, $varPropertie);

            //プロパティのコメントを作成
            $property = $propertyTemplate;
            $property = str_replace("{columnName}", $column->getComment() ?? ' ', $property);
            $property = str_replace("{type}", $column->getType()->getName() ?? ' ', $property);
            array_push($properties, $property);

            $toEntity = $toEntityTemplate;
            $toEntity = str_replace("{columnName}", $column->getName(), $toEntity);
            $toEntity = str_replace("{logicalName}", $column->getComment() ?? ' ', $toEntity);
            array_push($toEntitys, $toEntity);

            $setter = $setterTemplate;
            $setter = str_replace("{columnName}", $column->getComment() ?? ' ', $setter);
            array_push($setters, $setter);

            $cast = $castTemplate;
            $cast = str_replace("{columnName}", $column->getComment() ?? ' ', $cast);
            $cast = str_replace("{type}", $column->getType()->getName() ?? ' ', $cast);

            array_push($casts, $cast);
        }

        $Entity = $body;
        // プロパティ書き込み
        $varProperty = join("\n    ", $varProperties);
        $Entity = str_replace("{varProperty}", $varProperty, $Entity);

        // プロパティコメント書き込み
        $property = join("\n     ", $properties);
        $Entity = str_replace("{property}", $property, $Entity);

        // キャスト書き込み
        $cast = join(",\n        ", $casts);
        // $cast = mb_substr($cast, 1); //先頭文字削除
        $Entity = str_replace("{cast}", $cast ?? " ", $Entity);

        // コンストラクタ内のSet書き込み
        $setter = join("\n            ", $setters);
        $Entity = str_replace("{setter}", $setter, $Entity);

        // toEntity内のSet書き込み
        $toEntity = join("\n            ", $toEntitys);
        $Entity = str_replace("{toEntity}", $toEntity, $Entity);

        // その他Entity全体書き込み
        $Entity = str_replace("{feature}", $feature, $Entity);
        $Entity = str_replace("{tableName}", $tableName, $Entity);

        $path = app_path('Domain\\' . $feature . '\\' . $feature . 'Entity.php');
        $folderPath = app_path('Domain\\' . $feature);

        // フォルダが存在しない時
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, TRUE);
        }
        //ファイルが存在して、尚且つ上書きオプションが設定されていない場合はスキップ
        if (file_exists($path) and !$this->option('y')) {

            $this->info("{$feature} Entity already exists");
        } else if (file_exists($path) and $this->option('y')) {
            //ファイルを削除する
            if (unlink($path)) {
                echo $path . 'の削除に成功しました。';
            } else {
                echo $path . 'の削除に失敗しました。';
            }

            //ファイル出力
            file_put_contents($path, $Entity);
            $this->info("\n{$feature} Entity Overwrite");
        } else {
            //ファイル出力
            file_put_contents($path, $Entity);

            $this->info("{$feature} Entity created !!");
        }
    }

    /**
     * Requestの生成
     * @todo 型を記載予定
     * @var string
     */
    private function createRequest(String $appName, String $feature, String $tableName, array $columns)
    {

        $validationTemplate = "\"{logicalName}\" => []";
        $validationAttributeTemplate = "'{columnName}'   => '{logicalName}'";

        $body = file_get_contents(
            app_path("Common/Console/Commands/resources/Request.stub")
        );

        //検索フォームに表示したいものの配列
        $validations = [];
        $validationAttributes = [];

        foreach ($columns as $column) {

            // laravel用のカラムは覗く
            if (strpos($column->getName(), "_at") != false) {
                continue;
            }

            $validation_rule = $validationTemplate;
            $validation_rule = str_replace("{logicalName}", $column->getComment() ?? ' ', $validation_rule);
            //validation ruleを配列に入れる
            array_push($validations, $validation_rule);

            $validationAttribute = $validationAttributeTemplate;

            $validationAttribute = str_replace("{columnName}", $column->getName(), $validationAttribute);
            $validationAttribute = str_replace("{logicalName}", $column->getComment() ?? ' ', $validationAttribute);

            //validationAttribute を配列に入れる
            array_push($validationAttributes, $validationAttribute);
        }

        $Request = $body;
        $validation = join(",\n            ", $validations);
        $validationAttribute = join(",\n            ", $validationAttributes);

        $Request = str_replace("{validation}", $validation, $Request);
        $Request = str_replace("{validationAttribute}", $validationAttribute, $Request);

        // その他Request全体書き込み
        $Request = str_replace("{feature}", $feature, $Request);

        $path = app_path('Domain\\' . $feature . '\\' . $feature . 'Request.php');
        $folderPath = app_path('Domain\\' . $feature);

        // フォルダが存在しない時
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, TRUE);
        }
        //ファイルが存在して、尚且つ上書きオプションが設定されていない場合はスキップ
        if (file_exists($path) and !$this->option('y')) {

            $this->info("{$feature} Request already exists");
        } else if (file_exists($path) and $this->option('y')) {
            //ファイルを削除する
            if (unlink($path)) {
                echo $path . 'の削除に成功しました。';
            } else {
                echo $path . 'の削除に失敗しました。';
            }
            //ファイル出力
            file_put_contents($path, $Request);
            $this->info("\n{$feature} Request Overwrite");
        } else {
            //ファイル出力
            file_put_contents($path, $Request);

            $this->info("{$feature} Request created !!");
        }
    }
}
