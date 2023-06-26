<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property string $companyCode
 * @property string $companyName
 * @property string $companyDetail
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'Company';
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
        
    ];
    protected $casts = [
        'companyCode' => 'string',
        'companyName' => 'string',
        'companyDetail' => 'string',
    ];
}
