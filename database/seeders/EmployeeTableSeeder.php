<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Employee')->delete();
        
        \DB::table('Employee')->insert(array (
            0 => 
            array (
                'staffCode' => '1',
                'staffFirstName' => '田中',
                'staffLastName' => '太郎',
                'staffFirstNameKana' => 'たなか',
                'staffLastNameKana' => 'たろう',
                'sex' => '1',
                'departmentCode' => '1',
                'unitCode' => '1',
                'travelCost' => '1500.5000',
                'birthdate' => '19800510',
                'postcode' => '1234567',
                'address' => '東京都渋谷区',
                'tel' => '0312345678',
                'mail' => 'tanaka@example.com',
                'remark' => '備考欄の内容です。',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'staffCode' => '2',
                'staffFirstName' => '山田',
                'staffLastName' => '花子',
                'staffFirstNameKana' => 'やまだ',
                'staffLastNameKana' => 'はなこ',
                'sex' => '2',
                'departmentCode' => '1',
                'unitCode' => '1',
                'travelCost' => '1200.7500',
                'birthdate' => '19850922',
                'postcode' => '2345678',
                'address' => '東京都新宿区',
                'tel' => '0398765432',
                'mail' => 'yamada@example.com',
                'remark' => '備考のサンプルです。',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'staffCode' => '3',
                'staffFirstName' => '佐藤',
                'staffLastName' => '健太',
                'staffFirstNameKana' => 'さとう',
                'staffLastNameKana' => 'けんた',
                'sex' => '1',
                'departmentCode' => '2',
                'unitCode' => '2',
                'travelCost' => '1800.2500',
                'birthdate' => '19771203',
                'postcode' => '3456789',
                'address' => '東京都港区',
                'tel' => '0354321098',
                'mail' => 'sato@example.com',
                'remark' => 'ダミーデータの備考です。',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'staffCode' => '4',
                'staffFirstName' => '鈴木',
                'staffLastName' => '美香',
                'staffFirstNameKana' => 'すずき',
                'staffLastNameKana' => 'みか',
                'sex' => '2',
                'departmentCode' => '2',
                'unitCode' => '3',
                'travelCost' => '1400.0000',
                'birthdate' => '19920615',
                'postcode' => '4567890',
                'address' => '東京都目黒区',
                'tel' => '0321098765',
                'mail' => 'suzuki@example.com',
                'remark' => '備考のサンプルデータです。',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'staffCode' => '5',
                'staffFirstName' => '高橋',
                'staffLastName' => '一郎',
                'staffFirstNameKana' => 'たかはし',
                'staffLastNameKana' => 'いちろう',
                'sex' => '1',
                'departmentCode' => '3',
                'unitCode' => '4',
                'travelCost' => '1600.5000',
                'birthdate' => '19880228',
                'postcode' => '5678901',
                'address' => '東京都世田谷区',
                'tel' => '0376543210',
                'mail' => 'takahashi@example.com',
                'remark' => 'ダミーデータの備考欄です。',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}