<?php

// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        $tables = $this->getTables();

        return view('search.index', compact('tables'))
        ->with('selectTable','');
    }

    public function getColumns(Request $request)
    {
        $tables = $this->getTables();
        $selectTable = $request->selectTable;
        $getColumns = Schema::getColumnListing($selectTable);

        // $columns = $request->input('columns');


        return view('search.index')
        ->with('selectTable',$selectTable)
        ->with('getColumns',$getColumns)
        ->with('tables',$tables );
    }
    public function results(Request $request)
    {
        $table = $request->selectTable;
        $columns = $request->input('columns');

        $results = DB::table($table)->select($columns)->get();

        return view('search.results', compact('results'));
    }

    private function getTables()
    {
        $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE'");

        return array_column($tables, 'TABLE_NAME');
    }
}
