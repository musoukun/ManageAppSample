<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property string $staffCode
 * @property string $staffFirstName
 * @property string $staffLastName
 * @property string $staffFirstNameKana
 * @property string $staffLastNameKana
 * @property string $sex
 * @property string $departmentCode
 * @property string $sectionCode
 * @property string $unitCode
 * @property string $companyCode
 * @property string $companyName
 * @property string $contractFrom
 * @property string $contractTo
 * @property float $contractUnitPrice
 * @property string $travelCostType
 * @property float $travelCost
 * @property string $remark
 * @property datetime $created_at
 * @property datetime $updated_at
 * @property datetime $deleted_at
 */
class TempEmployee extends Model
{
    use HasFactory;

    protected $table = 'TempEmployee';
    protected $primaryKey = null;

    /**
     * when registering or renewing created_at,update_at unnecessary.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // default:true

    protected $fillable = [];
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'staffCode' => 'string',
        'staffFirstName' => 'string',
        'staffLastName' => 'string',
        'staffFirstNameKana' => 'string',
        'staffLastNameKana' => 'string',
        'sex' => 'string',
        'departmentCode' => 'string',
        'sectionCode' => 'string',
        'unitCode' => 'string',
        'companyCode' => 'string',
        'companyName' => 'string',
        'contractFrom' => 'string',
        'contractTo' => 'string',
        'contractUnitPrice' => 'float',
        'travelCostType' => 'string',
        'travelCost' => 'float',
        'remark' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
