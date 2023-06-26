<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Common\Trait\RefreshDatabaseLite;
use Tests\TestCase;
use App\Domain\Employee\EmployeeEntity;
use App\Domain\Employee\EmployeeRepository;
use App\Domain\Employee\EmployeeService;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;
use App\Common\Trait\StringTrait;

class EmployeeUpdateTest extends TestCase
{

    use WithFaker, DatabaseTransactions, StringTrait; //データベースにデータを残さないオプション

    // fakerを使うためのセットアップ
    protected function setUp(): void
    {
        parent::setUp();
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update()
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

        $firstname = fake()->firstName();
        $lastname = fake()->lastname();
        $firstnameKana = $this->kanji2Hira($firstname);
        $lastnameKana = $this->kanji2Hira($lastname);

        $work = new Employee(
            [
                'staffCode' => $entity->staffCode,
                'staffFirstName' => $firstname,
                'staffLastName' => $lastname,
                'staffFirstNameKana' => $firstnameKana,
                'staffLastNameKana' => $lastnameKana,
                'sex' => fake()->randomElement(['3']), //あえてこの値に
                'departmentCode' => fake()->randomNumber(5),
                'unitCode' => fake()->randomNumber(4),
                'travelCost' => fake()->randomNumber(5),
                'birthdate' => fake()->date('Ymd'),
                'postcode' => fake()->postcode(),
                'address' => fake()->address(),
                'tel' => fake()->phoneNumber(),
                'mail' => fake()->freeEmailDomain(),
                'remark' => fake()->realText(50),
            ]
        );

        //値オブジェクトで型チェック
        $updateEntity = new EmployeeEntity($work);
        //業務処理から登録
        $updateService = new EmployeeService($updateEntity);
        $updateService->update();

        //登録したデータ取得
        $updateData = Employee::where('staffCode', $entity->staffCode)->first();

        // updateしたいデータと取得したいデータが一致すること
        $this->assertEquals($entity->staffCode, $updateData->staffCode);
        $this->assertEquals($work->staffFirstName, $updateData->staffFirstName);
        $this->assertEquals($work->staffLastName, $updateData->staffLastName);
        $this->assertEquals($work->staffFirstNameKana, $updateData->staffFirstNameKana);
        $this->assertEquals($work->staffLastNameKana, $updateData->staffLastNameKana);
        $this->assertEquals($work->sex, $updateData->sex);
        $this->assertEquals($work->departmentCode, $updateData->departmentCode);
        $this->assertEquals($work->travelCost, $updateData->travelCost);
        $this->assertEquals($work->birthdate, $updateData->birthdate);
        $this->assertEquals($work->postcode, $updateData->postcode);
        $this->assertEquals($work->address, $updateData->address);
        $this->assertEquals($work->tel, $updateData->tel);
        $this->assertEquals($work->mail, $updateData->mail);
        $this->assertEquals($work->remark, $updateData->remark);

        // 変更前と変更後が一致しない事
        $this->assertNotEquals($insertData->staffFirstName, $updateData->staffFirstName);
        $this->assertNotEquals($insertData->staffLastName, $updateData->staffLastName);
        $this->assertNotEquals($insertData->staffFirstNameKana, $updateData->staffFirstNameKana);
        $this->assertNotEquals($insertData->staffLastNameKana, $updateData->staffLastNameKana);
        $this->assertNotEquals($insertData->sex, $updateData->sex);
        $this->assertNotEquals($insertData->departmentCode, $updateData->departmentCode);
        $this->assertNotEquals($insertData->travelCost, $updateData->travelCost);
        $this->assertNotEquals($insertData->birthdate, $updateData->birthdate);
        $this->assertNotEquals($insertData->postcode, $updateData->postcode);
        $this->assertNotEquals($insertData->address, $updateData->address);
        $this->assertNotEquals($insertData->tel, $updateData->tel);
        $this->assertNotEquals($insertData->mail, $updateData->mail);
        $this->assertNotEquals($insertData->remark, $updateData->remark);
    }
}
