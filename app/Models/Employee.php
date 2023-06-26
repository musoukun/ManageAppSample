<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\LoginUser as LoginUser;

/**
 * {TableComment}
 *
 * @property string $staffFirstName
 * @property string $staffCode
 * @property string $staffLastName
 * @property string $staffFirstNameKana
 * @property string $staffLastNameKana
 * @property string $sex
 * @property string $departmentCode
 * @property string $unitCode
 * @property float $travelCost
 * @property string $birthdate
 * @property string $postcode
 * @property string $address
 * @property string $tel
 * @property string $mail
 * @property string $remark
 * @property datetime $created_at
 * @property datetime $updated_at
 * @property datetime $deleted_at
 */
class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Employee';
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

    public function LoginUser()
    {
        return $this->hasOne(LoginUser::class, 'staffCode');
    }

    protected $fillable = [];
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'staffName',
        'staffNameKana'
    ];

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
        'unitCode' => 'string',
        'travelCost' => 'float',
        'birthdate' => 'string',
        'postcode' => 'string',
        'address' => 'string',
        'tel' => 'string',
        'mail' => 'string',
        'remark' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * 氏名を生成
     * 姓と名を半角スペースくぎりで結合
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function staffName(): Attribute
    {
        return Attribute::make(
            // アクセサ
            get: fn ($value, $attributes) => $attributes['staffFirstName'] . " " . $attributes['staffLastName']

            // ミューテータ
            // set: fn($value) => fn($value),
        );
    }

    /**
     * 氏名かなを生成
     * 姓と名を半角スペースくぎりで結合
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function staffNameKana(): Attribute
    {
        return Attribute::make(
            // アクセサ
            get: fn ($value, $attributes) => $attributes['staffFirstNameKana'] . " " . $attributes['staffLastNameKana']

            // ミューテータ
            // set: fn($value) => fn($value),
        );
    }
}
