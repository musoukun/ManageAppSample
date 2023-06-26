<?php

declare(strict_types=1);

namespace App\Domain\Employee;

use App\Models\Employee;
use App\Models\Department;
use App\Models\TempEmployee;
use App\Models\Code;
use App\Domain\Employee\EmployeeEntity;
use App\Common\Base\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as Collection;

/**
 * Employeeリポジトリ
 * @todo 
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Repository
 * @package App\Models\Employee;
 */
class EmployeeRepository extends Repository
{

    public function __construct(EmployeeEntity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param EmployeeEntity $entity
     * @return object $getdatas
     */
    public function getSerchData(int|null $paginate = null, int|null $page = null): Collection|LengthAwarePaginator
    {

        $getdatas = Employee::orderby("staffCode", "ASC")
            ->select(
                "staffCode",
                "staffFirstName",
                "staffLastName",
                "staffFirstNameKana",
                "staffLastNameKana",
                "mail"
            )
            ->when(!$this->is_nullorempty($this->entity->staffName), function (
                $query
            ) {
                $query
                    ->orwhere(
                        "staffFirstName",
                        "LIKE",
                        "%" . $this->entity->staffFirstName . "%"
                    )
                    ->orWhere(
                        "staffLastName",
                        "LIKE",
                        "%" . $this->entity->staffLastName . "%"
                    )
                    ->orWhere(
                        "staffFirstNameKana",
                        "LIKE",
                        "%" . $this->entity->staffFirstNameKana . "%"
                    )
                    ->orWhere(
                        "staffLastNameKana",
                        "LIKE",
                        "%" . $this->entity->staffLastNameKana . "%"
                    );
            })
            ->when(!$this->is_nullorempty($this->entity->departmentCode), function (
                $query
            ) {
                return $query->where("departmentCode", "=", $this->entity->departmentCode);
            })
            ->when(!$this->is_nullorempty($this->entity->staffCode), function (
                $query
            ) {
                return $query->where("staffCode", "=", $this->entity->staffCode);
            })
            ->when(isset($paginate), function ($query) use ($paginate, $page) {
                return $query->paginate($paginate, $page);
            }, function (
                $query
            ) {
                return $query->get();
            });

        return $getdatas;
    }

    /**
     * 
     * アクセサで、検索画面のプルダウンを加工して出力してます。
     * @return array $formDefaultValue DepartmentModel
     * @return $selectBusyo 部署選択(アクセサ)
     * @see Model Department
     */
    public function getFormData(): array
    {
        $formDefaultValue = [];

        return $formDefaultValue;
    }

    /**
     * Show the form for creating a new resource.
     * @return $selectdata 検索結果の詳細
     * @see Model Department
     * 検索結果（１件）の詳細を取得する。
     */
    public function getSelectData(string $staffCode): ?Object
    {
        $selectData = Employee::from('Employee')
            ->where('staffCode', $staffCode)
            ->first();

        return $selectData;
    }
}
