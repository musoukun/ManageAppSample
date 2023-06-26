<?php

declare(strict_types=1); 

namespace App\Common\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ModelMakerPgsql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "modelmaker-Pgsql {table?} {--y}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * カスタムしたCastをuseする必要がある場合の変数
     *
     * @var string
     */
    private ?string $useCustomCast;

    /**
     * Execute the console command.
     *
     * @return statement
     * @param array(
     *  template, tables ,columns ,table_name
     *  primary_key, model_name, path :string
     * )
     */
    public function handle(): void
    {

        //コマンドの引数にテーブルが指定されていた時
        $setTable = "and name = '" . $this->argument('table') . "'";

        //スタブを取得
        $template = file_get_contents(
            app_path("Common/Console/Commands/resources/Model.stub")
        );

        //テーブル一覧取得
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table_name) {

            $schema = DB::connection()->getDoctrineSchemaManager();

            // カラム情報を取得
            $columns = $schema->listTableDetails($table_name)->getColumns();
            $database = env('DB_DATABASE');

            //プライマリキー取得
            $key_array = DB::select("SELECT
                                        ccu.column_name as pk
                                    FROM
                                        information_schema.table_constraints tc
                                        ,information_schema.constraint_column_usage ccu
                                    WHERE
                                        tc.table_catalog='{$database}'
                                        AND
                                        tc.table_name='{$table_name}'
                                        AND
                                        tc.constraint_type='PRIMARY KEY'
                                        AND
                                        tc.table_catalog=ccu.table_catalog
                                        AND
                                        tc.table_schema=ccu.table_schema
                                        AND
                                        tc.table_name=ccu.table_name
                                        AND
                                        tc.constraint_name=ccu.constraint_name");

            //テーブル名をモデル名にする
            $model_name = trim($this->getModelNameFromTableName($table_name),'"');

            //生成するファイル名
            $path = app_path("Models/{$model_name}.php");

            //ファイルが存在して、尚且つ上書きオプションが設定されていない場合はスキップ
            if (file_exists($path) and !$this->option('y')) {
                $this->info("{$model_name} already exists");
                continue;
            }else if(file_exists($path) and $this->option('y')){
                // フォルダが存在しない時
                if(!file_exists(app_path("Models/Copy"))){
                    mkdir(app_path("Models/Copy"));
                }
                $path = app_path("Models/Copy/{$model_name}.php");
            }

            //コメント取得
            // $status = DB::select("show table status like '{$table_name}'");
            $status = DB::select("select
                                        pg_stat_user_tables.relname as TABLE_NAME
                                    ,pg_description.description as TABLE_COMMENT
                                from
                                        pg_stat_user_tables
                                    ,pg_description
                                where
                                    pg_stat_user_tables.relname =  '{$table_name}'
                                    and
                                    pg_stat_user_tables.relid=pg_description.objoid
                                    and
                                    pg_description.objsubid=0");
            if (!empty($status)) {
                $table_comment = $status[0]->Comment;
            }
            //置換処理
            $body = $template;
            if (!empty($status)) {
                $body = str_replace("{TableComment}", $table_comment, $body);
            }
            $body = str_replace(
                "{Properties}",
                $this->makePropertiesString($columns),
                $body
            );
            $body = str_replace("{ModelName}", $model_name, $body);
            $body = str_replace("{TableName}", "'".$model_name."'", $body);
            $body = str_replace(
                "{PrimaryKey}",
                $this->getPrimaryKey($key_array),
                $body
            );
            $body = str_replace(
                "{Dates}",
                $this->makeDatesString($columns),
                $body
            );
            $body = str_replace(
                "{Casts}",
                $this->makeCastsString($columns),
                $body
            );
            $body = str_replace("{use}", $this->useCustomCast ?? "", $body);

            // テスト用フラグ
            $testmode = false;

            if ($testmode) {
                //ファイル出力
                file_put_contents($path, $body);
                break;
            } else {
                //ファイル出力
                file_put_contents($path, $body);
            }

            $this->info("{$model_name} created !!");
        }

        $this->comment("END");
    }

    private function getPrimaryKey(array $key_array): string
    {
        if (!empty($key_array)) {
            //プライマリーキーの複数の文字列を連結
            $primary_key = "protected \$primaryKey = [";
            $counter = 0;
            $pk = [];
            foreach ($key_array as $key) {
                $pk = $key->pk;
                $counter++;
            }
            $pk = (array) $pk;
            $primary_key =
                $primary_key .
                implode(",", preg_replace("/^(.*?)$/", '"$1"', $pk));
            $primary_key = $primary_key . "];";
        } else {
            $primary_key = "protected \$primaryKey = null;";
        }
        return $primary_key;
    }

    private function getModelNameFromPrimaryKey(string $primary_key)
    {
        //末尾の _id を取る
        $snake = substr($primary_key, 0, -3);
        $words = explode("_", $snake);
        $camel = join(
            "",
            array_map(function ($word) {
                return ucfirst($word);
            }, $words)
        );
        return $camel;
    }

    private function getModelNameFromTableName(string $table_name)
    {
        //Modelの名称を加工する必要があればここに処理を記載する。
        $result = str_replace(["#", "'", "$"], "", $table_name);

        return $result;
    }

    private function makePropertiesString(array $columns)
    {
        $properties = [];

        foreach ($columns as $column) {
            if (strpos($column->getType()->getName(), "int") === 0) {
                $casts[$column->getName()] = "integer";
            } elseif (strpos($column->getType()->getName(), "tinyint") === 0) {
                $casts[$column->getName()] = "integer";
            } elseif (strpos($column->getType()->getName(), "decimal") === 0) {
                $properties[$column->getName()] = "float";
            } elseif (strpos($column->getType()->getName(), "datetime") === 0) {
                $properties[$column->getName()] = "\Illuminate\Support\Carbon";
            } elseif (strpos($column->getType()->getName(), "date") === 0) {
                $properties[$column->getName()] = "\Illuminate\Support\Carbon";
            }else {
                $properties[$column->getName()] = $column->getType()->getName();
            }
        }

        return join(
            "\n * ",
            array_map(
                function (string $key, string $value) {
                    return "@property {$value} \${$key}";
                },
                array_keys($properties),
                array_values($properties)
            )
        );
    }

    private function makeDatesString(array $columns)
    {
        $date_columns = array_filter($columns, function ($column) {
            return $column->getType()->getName() === "date" || $column->getType()->getName()  === "datetime";
        });

        return join(
            "\n        ",
            array_map(function ($date_column) {
                return "'{$date_column->getName()}',";
            }, $date_columns)
        );
    }

    private function makeCastsString(array $columns)
    {
        $casts = [];

        foreach ($columns as $column) {
            if (strpos($column->getType()->getName(), "int") === 0) {
                $casts[$column->Field] = "integer";
            } elseif (strpos($column->getType()->getName(), "tinyint") === 0) {
                $casts[$column->Field] = "integer";
            } elseif (strpos($column->getType()->getName(), "decimal") === 0) {
                $casts[$column->getName()] =  "float";
            } elseif (strpos($column->getType()->getName(), "date") === 0) {
                $casts[$column->getName()] = "date:Y-m-d";
            }else {
                $casts[$column->getName()] = $column->getType()->getName();
            }
        }

        return join(
            "\n        ",
            array_map(
                function (string $key, string $value) {
                    return "'{$key}' => '{$value}',";
                },
                array_keys($casts),
                array_values($casts)
            )
        );
    }
}
