<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property string $code
 * @property string $codeKey
 * @property string $codeValue
 * @property datetime $created_at
 * @property datetime $updated_at
 * @property datetime $deleted_at
 */
class Code extends Model
{
    use HasFactory;

    protected $table = 'Code';
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

    protected $appends = ['codeDatas'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'code' => 'string',
        'codeKey' => 'string',
        'codeValue' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    
    /**
     * コード区分を指定して区分を取得。
     * コード区分の条件だけが違うSQLが多用されていたので作成
     * @param string $codeKey
     * @return object
     */
    public static function getCodeDatas(string $codeKey): object
    {
        return Code::where("codeKey", "=", $codeKey)
            ->Select("code", "codeValue")
            ->OrderBy("codeKey", "ASC")
            ->get();
    }
}
