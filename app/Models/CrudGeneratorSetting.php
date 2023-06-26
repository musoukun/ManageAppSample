<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property string $feature
 * @property string $tableName
 * @property string $columnName
 * @property string $logicalName
 * @property string $code
 * @property string $type
 * @property string $validation
 * @property string $tag
 * @property string $appName
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 */
class CrudGeneratorSetting extends Model
{
    use HasFactory;

    protected $table = 'CrudGeneratorSetting';
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
        'feature' => 'string',
        'tableName' => 'string',
        'columnName' => 'string',
        'logicalName' => 'string',
        'code' => 'string',
        'type' => 'string',
        'validation' => 'string',
        'tag' => 'string',
        'appName' => 'string',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'deleted_at' => 'date:Y-m-d',
    ];
}
    