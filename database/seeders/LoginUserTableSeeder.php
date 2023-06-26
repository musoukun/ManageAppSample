<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoginUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('LoginUser')->delete();
        
        \DB::table('LoginUser')->insert(array (
            0 => 
            array (
                'loginUserId' => 'test',
                'staffCode' => '1',
                'displayName' => '田中太郎',
                'mail' => 'tanaka@example.com',
                'password' => 'password123',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'loginUserId' => 'user002',
                'staffCode' => '2',
                'displayName' => '山田花子',
                'mail' => 'yamada@example.com',
                'password' => 'secret456',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'loginUserId' => 'user003',
                'staffCode' => '3',
                'displayName' => '佐藤健太',
                'mail' => 'sato@example.com',
                'password' => 'pass1234',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'loginUserId' => 'user004',
                'staffCode' => '4',
                'displayName' => '鈴木美香',
                'mail' => 'suzuki@example.com',
                'password' => 'password789',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'loginUserId' => 'user005',
                'staffCode' => '5',
                'displayName' => '高橋一郎',
                'mail' => 'takahashi@example.com',
                'password' => 'secret789',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}