<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Company')->delete();
        
        \DB::table('Company')->insert(array (
            0 => 
            array (
                'companyCode' => '1',
                'companyName' => '株式会社サンプル',
                'companyDetail' => 'サンプル詳細情報',
            ),
            1 => 
            array (
                'companyCode' => '2',
                'companyName' => '有限会社テスト',
                'companyDetail' => 'テスト詳細情報',
            ),
            2 => 
            array (
                'companyCode' => '3',
                'companyName' => '株式会社データ',
                'companyDetail' => 'データ詳細情報',
            ),
            3 => 
            array (
                'companyCode' => '4',
                'companyName' => '有限会社サンプルデータ',
                'companyDetail' => 'サンプルデータ詳細情報',
            ),
            4 => 
            array (
                'companyCode' => '5',
                'companyName' => '株式会社テストデータ',
                'companyDetail' => 'テストデータ詳細情報',
            ),
        ));
        
        
    }
}