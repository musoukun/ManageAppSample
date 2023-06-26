<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TempEmployeeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('TempEmployee')->delete();
        
        \DB::table('TempEmployee')->insert(array (
            0 => 
            array (
                'staffCode' => '1',
                'staffFirstName' => '太郎',
                'staffLastName' => '山田',
                'staffFirstNameKana' => 'タロウ',
                'staffLastNameKana' => 'ヤマダ',
                'sex' => '1',
                'departmentCode' => '1',
                'sectionCode' => '1',
                'unitCode' => '1',
                'companyCode' => '1',
                'companyName' => '株式会社ABC',
                'contractFrom' => '20230601',
                'contractTo' => '20240601',
                'contractUnitPrice' => '5000.0000',
                'travelCostType' => '1',
                'travelCost' => '10000.0000',
                'remark' => '備考',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'staffCode' => '2',
                'staffFirstName' => '次郎',
                'staffLastName' => '佐藤',
                'staffFirstNameKana' => 'ジロウ',
                'staffLastNameKana' => 'サトウ',
                'sex' => '2',
                'departmentCode' => '1',
                'sectionCode' => '1',
                'unitCode' => '1',
                'companyCode' => 'C002',
                'companyName' => '株式会社XYZ',
                'contractFrom' => '20230701',
                'contractTo' => '20240701',
                'contractUnitPrice' => '6000.0000',
                'travelCostType' => '2',
                'travelCost' => '15000.0000',
                'remark' => '備考2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'staffCode' => '3',
                'staffFirstName' => '花子',
                'staffLastName' => '田中',
                'staffFirstNameKana' => 'ハナコ',
                'staffLastNameKana' => 'タナカ',
                'sex' => '1',
                'departmentCode' => '2',
                'sectionCode' => '1',
                'unitCode' => '2',
                'companyCode' => '3',
                'companyName' => '株式会社123',
                'contractFrom' => '20230801',
                'contractTo' => '20240801',
                'contractUnitPrice' => '5500.0000',
                'travelCostType' => '1',
                'travelCost' => '12000.0000',
                'remark' => '備考3',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'staffCode' => '4',
                'staffFirstName' => '次郎',
                'staffLastName' => '山田',
                'staffFirstNameKana' => 'ジロウ',
                'staffLastNameKana' => 'ヤマダ',
                'sex' => '2',
                'departmentCode' => '1',
                'sectionCode' => '2',
                'unitCode' => '1',
                'companyCode' => '4',
                'companyName' => '株式会社ABC',
                'contractFrom' => '20230901',
                'contractTo' => '20240901',
                'contractUnitPrice' => '4500.0000',
                'travelCostType' => '2',
                'travelCost' => '18000.0000',
                'remark' => '備考4',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'staffCode' => '5',
                'staffFirstName' => '美紀',
                'staffLastName' => '鈴木',
                'staffFirstNameKana' => 'ミキ',
                'staffLastNameKana' => 'スズキ',
                'sex' => '1',
                'departmentCode' => '3',
                'sectionCode' => '2',
                'unitCode' => '2',
                'companyCode' => '5',
                'companyName' => '株式会社XYZ',
                'contractFrom' => '20231001',
                'contractTo' => '20241001',
                'contractUnitPrice' => '4800.0000',
                'travelCostType' => '1',
                'travelCost' => '11000.0000',
                'remark' => '備考5',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}