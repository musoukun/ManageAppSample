<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property string $departmentCode
 * @property string $departmentName
 * @property string $departmentNameKana
 * @property string $sectionCode
 * @property string $sectionName
 * @property string $sectionNameKana
 * @property string $unitCode
 * @property string $unitName
 * @property string $unitNameKana
 */
class Department extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'Department';
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

    protected $appends = ['codeAndName'];
    protected $dates = [
        
    ];
    protected $casts = [
        'departmentCode' => 'string',
        'departmentName' => 'string',
        'departmentNameKana' => 'string',
        'sectionCode' => 'string',
        'sectionName' => 'string',
        'sectionNameKana' => 'string',
        'unitCode' => 'string',
        'unitName' => 'string',
        'unitNameKana' => 'string',
    ];

    /**
     * 氏名（表示用）を生成
     * 姓と名を半角スペースくぎりで結合
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function codeAndName(): Attribute
    {
        return Attribute::make(
            // アクセサ
            get: fn($value, $attributes) => $attributes['departmentCode'] . " " . $attributes['departmentName']

            // ミューテータ
            // set: fn($value) => fn($value),
        );
    }

}
