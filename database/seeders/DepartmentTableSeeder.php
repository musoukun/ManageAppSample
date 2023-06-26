<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Department')->delete();
        
        \DB::table('Department')->insert(array (
            0 => 
            array (
                'departmentCode' => '1',
                'departmentName' => '営業部',
                'departmentNameKana' => 'えいぎょうぶ',
                'sectionCode' => '1',
                'sectionName' => '第一課',
                'sectionNameKana' => 'だいいちか',
                'unitCode' => '1',
                'unitName' => '総務課',
                'unitNameKana' => 'そうむか',
            ),
            1 => 
            array (
                'departmentCode' => '1',
                'departmentName' => '営業部',
                'departmentNameKana' => 'えいぎょうぶ',
                'sectionCode' => '2',
                'sectionName' => '第二課',
                'sectionNameKana' => 'だいにか',
                'unitCode' => '2',
                'unitName' => '人事課',
                'unitNameKana' => 'じんじか',
            ),
            2 => 
            array (
                'departmentCode' => '2',
                'departmentName' => '生産部',
                'departmentNameKana' => 'せいさんぶ',
                'sectionCode' => '3',
                'sectionName' => '第一課',
                'sectionNameKana' => 'だいいちか',
                'unitCode' => '3',
                'unitName' => '製造課',
                'unitNameKana' => 'せいぞうか',
            ),
            3 => 
            array (
                'departmentCode' => '2',
                'departmentName' => '生産部',
                'departmentNameKana' => 'せいさんぶ',
                'sectionCode' => '4',
                'sectionName' => '第二課',
                'sectionNameKana' => 'だいにか',
                'unitCode' => '4',
                'unitName' => '品質管理課',
                'unitNameKana' => 'ひんしつかんりか',
            ),
            4 => 
            array (
                'departmentCode' => '3',
                'departmentName' => '総務部',
                'departmentNameKana' => 'そうむぶ',
                'sectionCode' => '5',
                'sectionName' => '総務課',
                'sectionNameKana' => 'そうむか',
                'unitCode' => '5',
                'unitName' => '庶務課',
                'unitNameKana' => 'しょむか',
            ),
        ));
        
        
    }
}