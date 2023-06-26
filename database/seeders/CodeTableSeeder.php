<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CodeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Code')->delete();
        
        \DB::table('Code')->insert(array (
            0 => 
            array (
                'code' => '1',
                'codeKey' => 'sex',
                'codeValue' => '男',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'code' => '2',
                'codeKey' => 'sex',
                'codeValue' => '女',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'code' => '1',
                'codeKey' => 'TravelCost',
                'codeValue' => '月額',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'code' => '2',
                'codeKey' => 'TravelCost',
                'codeValue' => '日割',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}