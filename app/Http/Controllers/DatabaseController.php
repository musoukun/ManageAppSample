<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function auto_coder(Request $request)
    {
        $target_db = '';
        $target_table = '';
        $table_names = [];
        $columns = [];
        $with_comment = $request->filled('with_comment');

        // データベース名を取得
        $databases = DB::select('SELECT DB_NAME() AS DatabaseName');
        $database_names = array_map(function($database){

            return $database->DatabaseName;

        }, $databases);

        try {

            if($request->filled('target_db')) {

                $connection = env('DB_CONNECTION');
                $target_db = $request->target_db;
                config(['database.connections.'. $connection .'.database' => $target_db]); // DB名を上書き
                DB::reconnect($connection); // DBを再接続

                if($request->filled('target_table')) {

                    // カラム情報を取得
                    $target_table = $request->target_table;
                    $columns = DB::select("SELECT
                                                c.name as Field
                                            FROM
                                                sys.objects t
                                                INNER JOIN sys.columns c ON
                                                    t.object_id = c.object_id
                                            WHERE
                                                t.type = 'U'
                                            AND
                                                t.name = '{$target_table}'");

                }

                // テーブル名を取得
                $tables = DB::select("SELECT name
                                        FROM sysobjects
                                        WHERE xtype = 'U'
                                        ORDER BY name");

                $table_names = array_map(function($table) use($target_db){

                    return $table->{'name'};

                }, $tables);

            }

        } catch (\Exception $e) {

            echo 'データベース or テーブル情報が間違っています！';
            echo $e;

        }

        return view('database.auto_coder')->with([
            'target_db' => $target_db,
            'target_table' => $target_table,
            'target_table_singular' => Str::singular($target_table),
            'target_table_camel' => Str::singular(Str::camel($target_table)),
            'target_table_studly' => Str::singular(Str::studly($target_table)),
            'database_names' => $database_names,
            'table_names' => $table_names,
            'columns' => $columns,
            'with_comment' => $with_comment
        ]);
    }
}
