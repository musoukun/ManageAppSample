<?php
declare(strict_types=1);

namespace App\Domain\TempEmployee;

use App\Common\Base\Entity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model as Model;
use App\Models\TempEmployee;

/**
 * Class TempEmployeeEntity
 * {Comment}
 *
 * @access public
 * @author waroshi@gmail.com
 * @copyright musoukun
 * @category Entity
 * @package App\Domain\TempEmployee;
 */
class TempEmployeeEntity extends Entity
{
    /** @var string 項目：スタッフコード **/
    public readonly ?string $staffCode;

    /** @var string 項目：スタッフの名 **/
    public readonly ?string $staffFirstName;

    /** @var string 項目：スタッフの姓 **/
    public readonly ?string $staffLastName;

    /** @var string 項目：スタッフの名（カナ） **/
    public readonly ?string $staffFirstNameKana;

    /** @var string 項目：スタッフの姓（カナ） **/
    public readonly ?string $staffLastNameKana;

    /** @var string 項目：性別 **/
    public readonly ?string $sex;

    /** @var string 項目：部門コード **/
    public readonly ?string $departmentCode;

    /** @var string 項目：課コード **/
    public readonly ?string $sectionCode;

    /** @var string 項目：係コード **/
    public readonly ?string $unitCode;

    /** @var string 項目：会社コード **/
    public readonly ?string $companyCode;

    /** @var string 項目：会社名 **/
    public readonly ?string $companyName;

    /** @var string 項目：契約開始日 **/
    public readonly ?string $contractFrom;

    /** @var string 項目：契約終了日 **/
    public readonly ?string $contractTo;

    /** @var decimal 項目：契約単価 **/
    public readonly ?decimal $contractUnitPrice;

    /** @var string 項目：交通費タイプ **/
    public readonly ?string $travelCostType;

    /** @var decimal 項目：交通費 **/
    public readonly ?decimal $travelCost;

    /** @var string 項目：備考 **/
    public readonly ?string $remark;


    /**
     * @var array キャストルール
     */
    protected $casts = [
        'スタッフコード' => 'string',
        'スタッフの名' => 'string',
        'スタッフの姓' => 'string',
        'スタッフの名（カナ）' => 'string',
        'スタッフの姓（カナ）' => 'string',
        '性別' => 'string',
        '部門コード' => 'string',
        '課コード' => 'string',
        '係コード' => 'string',
        '会社コード' => 'string',
        '会社名' => 'string',
        '契約開始日' => 'string',
        '契約終了日' => 'string',
        '契約単価' => 'decimal',
        '交通費タイプ' => 'string',
        '交通費' => 'decimal',
        '備考' => 'string'
    ];

    /**
     * TempEmployeeEntity __construct.
     * コンストラクタ
     * @property string スタッフコード
     * @property string スタッフの名
     * @property string スタッフの姓
     * @property string スタッフの名（カナ）
     * @property string スタッフの姓（カナ）
     * @property string 性別
     * @property string 部門コード
     * @property string 課コード
     * @property string 係コード
     * @property string 会社コード
     * @property string 会社名
     * @property string 契約開始日
     * @property string 契約終了日
     * @property decimal 契約単価
     * @property string 交通費タイプ
     * @property decimal 交通費
     * @property string 備考
     */
    public function __construct($obj)
    {

        if ($obj instanceof Request) {

            $obj = $this->requestCast($obj);//型チェック及び変換

            $this->スタッフコード = $obj->スタッフコード;
            $this->スタッフの名 = $obj->スタッフの名;
            $this->スタッフの姓 = $obj->スタッフの姓;
            $this->スタッフの名（カナ） = $obj->スタッフの名（カナ）;
            $this->スタッフの姓（カナ） = $obj->スタッフの姓（カナ）;
            $this->性別 = $obj->性別;
            $this->部門コード = $obj->部門コード;
            $this->課コード = $obj->課コード;
            $this->係コード = $obj->係コード;
            $this->会社コード = $obj->会社コード;
            $this->会社名 = $obj->会社名;
            $this->契約開始日 = $obj->契約開始日;
            $this->契約終了日 = $obj->契約終了日;
            $this->契約単価 = $obj->契約単価;
            $this->交通費タイプ = $obj->交通費タイプ;
            $this->交通費 = $obj->交通費;
            $this->備考 = $obj->備考;

        }elseif($obj instanceof Model){

            $this->model2Entity($obj);

        }

    }

    /**
     * TempEmployeeEntity model2Entity.
     * Modelへの変換
     * @param Model $model
     */
    public function model2Entity(Model $model)
    {
        $this->staffCode = $model->スタッフコード;
            $this->staffFirstName = $model->スタッフの名;
            $this->staffLastName = $model->スタッフの姓;
            $this->staffFirstNameKana = $model->スタッフの名（カナ）;
            $this->staffLastNameKana = $model->スタッフの姓（カナ）;
            $this->sex = $model->性別;
            $this->departmentCode = $model->部門コード;
            $this->sectionCode = $model->課コード;
            $this->unitCode = $model->係コード;
            $this->companyCode = $model->会社コード;
            $this->companyName = $model->会社名;
            $this->contractFrom = $model->契約開始日;
            $this->contractTo = $model->契約終了日;
            $this->contractUnitPrice = $model->契約単価;
            $this->travelCostType = $model->交通費タイプ;
            $this->travelCost = $model->交通費;
            $this->remark = $model->備考;
    }
}