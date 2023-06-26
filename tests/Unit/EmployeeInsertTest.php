<?php

namespace tests\Unit;

//データベースにデータを残さないオプション 別パターン
// use App\Common\Trait\RefreshDatabaseLite;
// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Domain\Employee\EmployeeEntity;
use App\Domain\Employee\EmployeeRepository;
use App\Domain\Employee\EmployeeService;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;

class EmployeeInsertTest extends TestCase
{

    use DatabaseTransactions; //データベースにデータを残さないオプション

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insert()
    {
        //テストデータ作成
        $insertData = Employee::factory()->make([
            'staffCode' => null,
        ]);

        //値オブジェクトで型チェック
        $entity = new EmployeeEntity($insertData);

        //業務処理から登録
        $service = new EmployeeService($entity);
        $service->insert();

        //登録したデータ取得
        $data = Employee::where('staffCode', $entity->staffCode)->first();

        $this->assertEquals($data->staffCode, $entity->staffCode);
        $this->assertEquals($data->staffFirstName, $entity->staffFirstName);
        $this->assertEquals($data->staffLastName, $entity->staffLastName);
        $this->assertEquals($data->staffFirstNameKana, $entity->staffFirstNameKana);
        $this->assertEquals($data->staffLastNameKana, $entity->staffLastNameKana);
        $this->assertEquals($data->sex, $entity->sex);
        $this->assertEquals($data->departmentCode, $entity->departmentCode);
        $this->assertEquals($data->travelCost, $entity->travelCost);
        $this->assertEquals($data->birthdate, $entity->birthdate);
        $this->assertEquals($data->postcode, $entity->postcode);
        $this->assertEquals($data->address, $entity->address);
        $this->assertEquals($data->tel, $entity->tel);
        $this->assertEquals($data->mail, $entity->mail);
        $this->assertEquals($data->remark, $entity->remark);
    }
}
