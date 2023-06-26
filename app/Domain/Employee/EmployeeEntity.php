<?php

declare(strict_types=1);

namespace App\Domain\Employee;

use Illuminate\Http\Request;
use App\Common\Base\Entity;
use App\Common\Trait\HasGetter;
use App\Models\Employee;

/**
 * Class EmployeeEntity
 * Employeeの情報を表現するEntityクラス
 * （例外が必要な値チェックとか実装するとよいかも）
 *
 * @todo
 *
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Entity
 * @package App\UseCase\Employee;
 */
final class EmployeeEntity extends Entity
{
    // use HasGetter;

    /** @var string 画面項目：社員コード **/
    public ?string $staffCode;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $staffFirstName;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $staffLastName;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $staffFirstNameKana;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $staffLastNameKana;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $sex;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $departmentCode;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $unitCode;

    /** @var string 画面項目：社員姓 **/
    public readonly ?float $travelCost;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $birthdate;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $postcode;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $address;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $tel;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $mail;

    /** @var string 画面項目：社員姓 **/
    public readonly ?string $remark;


    // 検索用の変数
    /** @var string 検索ワード：姓 **/
    public ?string $serchFirstName;

    /** @var string 検索ワード：名 **/
    public ?string $serchLastName;

    /** @var string 検索ワード：社員名 **/
    public ?string $staffName;

    /**
     * @var array キャストルール
     */
    protected $casts = [
        "travelCost" => "float",
    ];

    /**
     * EmployeeEntity __construct.
     * 値セット
     * 
     * @property string $staffCode
     * @property string $staffFirstName
     * @property string $staffLastName
     * @property string $staffFirstNameKana
     * @property string $staffLastNameKana
     * @property string $sex
     * @property string $departmentCode
     * @property string $unitCode
     * @property float  $travelCost
     * @property string $birthdate
     * @property string $postcode
     * @property string $address
     * @property string $tel
     * @property string $mail
     * @property string $remark
     * 
     */
    public function __construct($obj)
    {
        if ($obj instanceof Request) {
            $obj = $this->requestCast($obj);
        }

        $this->staffCode  = $obj->staffCode ;
        $this->staffFirstName = $obj->staffFirstName;
        $this->staffLastName = $obj->staffLastName;
        $this->staffFirstNameKana = $obj->staffFirstNameKana;
        $this->staffLastNameKana = $obj->staffLastNameKana;
        $this->sex = $obj->sex;
        $this->departmentCode = $obj->departmentCode;
        $this->unitCode = $obj->unitCode;
        $this->travelCost = $obj->travelCost;
        $this->birthdate = $obj->birthdate;
        $this->postcode = $obj->postcode;
        $this->address = $obj->address;
        $this->tel = $obj->tel;
        $this->mail = $obj->mail;
        $this->remark = $obj->remark;

        //検索画面用
        $this->staffName = $obj->staffName ?? '';

        //スペース区切りで姓と名を分割して項目にセット
        $this->setSerchFirstLast();
    }

    /**
     * EmployeeEntity
     * 社員名がセットされていたらを姓名に分割して
     * 検索用の値を変数にセットする
     */
    public function setSerchFirstLast()
    {
        if (isset($this->staffName)) {
            $this->extractKeywords($this->staffName);
            if (
                strpos($this->staffName, "　") == true or
                strpos($this->staffName, " ") == true
            ) {
                //姓名分割
                $staffNameSeiMei = $this->extractKeywords($this->staffName);

                $this->SerchSyainSei = $staffNameSeiMei[0];
                $this->SerchSyainMei = $staffNameSeiMei[1];
            } else {
                $this->serchFirstName = $this->staffName;
                $this->serchLastName = $this->staffName;
            }
        }
    }

    /**
     * EmployeeEntity __construct.
     * 値セット
     * @return integer $staffCode
     */
    public function incrimentStaffCode(){
        //社員コード生成処理
        $wStaffCode = Employee::max('staffCode') + 1 ?? '1';
        $this->staffCode = (string)$wStaffCode;
    }

}
