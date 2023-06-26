<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * {TableComment}
 *
 * @property bigint $id
 * @property string $tokenable_type
 * @property bigint $tokenable_id
 * @property string $name
 * @property string $token
 * @property text $abilities
 * @property datetime $last_used_at
 * @property datetime $expires_at
 * @property datetime $created_at
 * @property datetime $updated_at
 */
class personal_access_tokens extends Model
{
    use HasFactory;

    protected $table = 'personal_access_tokens';
    protected $primaryKey = ["id"];

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
        'last_used_at',
        'expires_at',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'id' => 'bigint',
        'tokenable_type' => 'string',
        'tokenable_id' => 'bigint',
        'name' => 'string',
        'token' => 'string',
        'abilities' => 'text',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
