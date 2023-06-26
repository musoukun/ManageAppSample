<?php

declare(strict_types=1);

namespace App\Domain\Employee;

use Illuminate\Pagination\LengthAwarePaginator as LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as Collection;
use App\Models\Employee as Employee;
use App\Models\Department;
use App\Domain\Employee\EmployeeRepository;
use Illuminate\Http\Request;
use App\Domain\Employee\EmployeeEntity;
use App\Common\Base\Service;
use Illuminate\Support\Facades\DB;

/**
 * EmployeeService
 *
 * @todo パッケージ間の依存関係は、できるだけ疎結合にしたい
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Service
 * @package App\UseCase\Employee;
 *
 */
class EmployeeService extends Service
{
    /**
     * EmployeeService __construct.
     */
    public function __construct(EmployeeEntity $entity)
    {
        $this->entity = $entity;
        $this->EmployeeRepository = new EmployeeRepository($entity);
    }

    /**
     * Employeeservice search.
     * @todo Entityに姓名分割の加工を実装するか迷う
     * @param EmployeeEntity $entity
     * @return Object
     */
    public function search(int|null $paginate = null, int|null $page = null): Collection|LengthAwarePaginator
    {
        $searchDatas = $this->EmployeeRepository->getSerchData($paginate, $page);
        return $searchDatas;
    }

    /**
     * Employeeservice select データ照会.
     * @param string $staffCode
     * @return Object
     */
    public function select(string $staffCode): ?Object
    {
        $selectData = $this->EmployeeRepository->getSelectData($staffCode);
        return $selectData;
    }

    /**
     * Employeeservice getFormData.
     * 検索フォームのデータ取得
     * @return array
     */
    public function getFormData(): array
    {
        $formDefaultValue = $this->EmployeeRepository->getFormData();
        return $formDefaultValue;
    }

    /**
     * Employeeservice insert.
     * Employee新規登録
     * @param EmployeeEntity $entity
     * @return string $staffCode
     */
    public function insert(): string
    {
        //新規staffCodeを設定
        $this->entity->incrimentStaffCode();

        // Insertする値をEmployeeModelにセット
        $insdata = $this->toEmployee(new Employee);

        // Eloquentのみで登録するのでServiceに記載
        $insdata->save();

        //登録時のstaffCode返却
        return $insdata->staffCode;
    }

    /**
     * Employeeservice insert.
     * Employeeの編集
     * @param EmployeeEntity $entity
     */
    public function update()
    {

        DB::transaction(function () {

            // Eloquentのみで登録するのでServiceに記載
            $updateData = Employee::lockForUpdate()->where('staffCode', $this->entity->staffCode)->first();

            $this->toEmployee($updateData)->update();

            //IDを主キーにしていないので、この記法が使えない↓
            //$this->toEmployee($updateData)->save();
        });
    }

    /**
     * Employeeservice delete.
     * Employeeの編集
     * @param EmployeeEntity $entity
     */
    public function delete()
    {

        DB::transaction(function () {
            // Eloquentのみで登録するのでServiceに記載
            Employee::where('staffCode', $this->entity->staffCode)->delete();
        });
    }

    /**
     * Employeeservice getFormData.
     * EmployeeModelへのデータセットを行う処理
     * @todo Entityに実装するか考えたい
     * @param Employee $employee
     * @return Employee
     */
    public function toEmployee(
        Employee $employee
    ): Employee {

        // 更新日時は更新しない
        $employee->timestamps = false;

        $employee->staffCode = $this->entity->staffCode;
        $employee->staffFirstName = $this->entity->staffFirstName;
        $employee->staffLastName = $this->entity->staffLastName;
        $employee->staffFirstNameKana = $this->entity->staffFirstNameKana;
        $employee->staffLastNameKana = $this->entity->staffLastNameKana;
        $employee->sex = $this->entity->sex;
        $employee->departmentCode = $this->entity->departmentCode;
        $employee->birthdate = $this->entity->birthdate;
        $employee->postcode = $this->entity->postcode;
        $employee->address = $this->entity->address;
        $employee->tel = $this->entity->tel;
        $employee->mail = $this->entity->mail;
        $employee->remark = $this->entity->remark;
        $employee->travelCost = $this->entity->travelCost;

        return $employee;
    }
}
