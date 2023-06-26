<?php

declare(strict_types=1); // 強い型付けの設定

namespace App\Common\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ModelMakerSqlsrv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "modelmaker-sqlsrv {table?} {--y}";

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

        //何もReturnしない
        //スタブを取得
        $template = file_get_contents(
            app_path("Common/Console/Commands/resources/Model.stub")
        );

        //テーブル一覧取得
        $tables = DB::select("SELECT name
                                FROM sysobjects
                                WHERE xtype = 'U'"
                                . $setTable ?? null .
                                " ORDER BY name");

        foreach ($tables as $table) {
            $table = (array) $table;
            $table_name = array_values($table)[0];

            //カラム取得
            $columns = DB::select("SELECT
                                        c.name                  AS Field,
                                        type_name(user_type_id) AS Type,
                                        precision               AS precision,
                                        scale                   AS scale,
                                        CASE
                                            WHEN
                                                is_nullable = 1
                                            THEN
                                                'YES'
                                            ELSE
                                                'NO'
                                        END AS nullable
                                    FROM
                                        sys.objects t
                                        INNER JOIN sys.columns c ON
                                            t.object_id = c.object_id
                                    WHERE
                                        t.type = 'U'
                                    AND
                                        t.name = '{$table_name}'");

            // echo($columns[0]);

            //プライマリキー取得
            $key_array = DB::select("SELECT
                                            cols.name AS pk
                                        FROM
                                            sys.tables AS tbls
                                                INNER JOIN sys.key_constraints AS key_const ON
                                                    tbls.object_id = key_const.parent_object_id AND key_const.type = 'PK'
                                                    AND tbls.name = '{$table_name}'
                                                INNER JOIN sys.index_columns AS idx_cols ON
                                                    key_const.parent_object_id = idx_cols.object_id
                                                    AND key_const.unique_index_id  = idx_cols.index_id
                                                INNER JOIN sys.columns AS cols ON
                                                    idx_cols.object_id = cols.object_id
                                                    AND idx_cols.column_id = cols.column_id");

            // //プライマリーキー名から _id をとったものをモデル名にする
            // $model_name = $this->getModelNameFromPrimaryKey($primary_key);

            //テーブル名をモデル名にする
            $model_name = $this->getModelNameFromTableName($table_name);

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
									ep.value  as COMMENT
								from
										sys.tables              t
									,sys.extended_properties ep
								where
									t.name = '{$table_name}'
									and
									t.object_id = ep.major_id
									and
									ep.minor_id = 0
								;");
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
            $body = str_replace("{TableName}", $table_name, $body);
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
            $testmode = true;

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
            if (strpos($column->Type, "int") === 0) {
                $properties[$column->Field] = "integer";
            } elseif (strpos($column->Type, "tinyint") === 0) {
                $properties[$column->Field] = "integer";
            } elseif (strpos($column->Type, "decimal") === 0) {
                $properties[$column->Field] = "float";
            } elseif (strpos($column->Type, "nvarchar") === 0) {
                //SQLServerの定義に変更 varchar → nverchar
                $properties[$column->Field] = "string";
            } elseif (strpos($column->Type, "text") === 0) {
                $properties[$column->Field] = "string";
            } elseif (strpos($column->Type, "datetime") === 0) {
                $properties[$column->Field] = "\Illuminate\Support\Carbon";
            } elseif (strpos($column->Type, "timestamp") === 0) {
                $properties[$column->Field] = "App\Common\Casts\SqlsrvTimestamp";
            } elseif (strpos($column->Type, "date") === 0) {
                $properties[$column->Field] = "\Illuminate\Support\Carbon";
            } else {
                $properties[$column->Field] = "string";
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
            return $column->Type === "date" || $column->Type === "datetime";
        });

        return join(
            "\n        ",
            array_map(function ($date_column) {
                return "'{$date_column->Field}',";
            }, $date_columns)
        );
    }

    private function makeCastsString(array $columns)
    {
        $casts = [];

        foreach ($columns as $column) {
            if (strpos($column->Type, "int") === 0) {
                $casts[$column->Field] = "'integer'";
            } elseif (strpos($column->Type, "tinyint") === 0) {
                $casts[$column->Field] = "'integer'";
            } elseif (strpos($column->Type, "decimal") === 0) {
                $casts[$column->Field] = "'float'";
            } elseif (strpos($column->Type, "datetime") === 0) {
                $casts[$column->Field] = "'date:Y-m-d H:i:s'";
            } elseif (strpos($column->Type, "timestamp") === 0) {
                $casts[$column->Field] = "SqlsrvTimestamp::Class";
                $this->useCustomCast = "use App\Common\Casts\SqlsrvTimestamp;";
            } elseif (strpos($column->Type, "date") === 0) {
                $casts[$column->Field] = "'date:Y-m-d'";
            } elseif (strpos($column->Type, "'nvarchar'") === 0) {
                //SQLServerの定義に変更 varchar → nverchar
                $casts[$column->Field] = "'string'";
            } elseif (strpos($column->Type, "text") === 0) {
                $casts[$column->Field] = "'string'";
            } else {
                $casts[$column->Field] = "'string'";
            }
        }

        return join(
            "\n        ",
            array_map(
                function (string $key, string $value) {
                    return "'{$key}' => {$value},";
                },
                array_keys($casts),
                array_values($casts)
            )
        );
    }
}
