<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;//ハッシュ化
use Laravel\Sanctum\HasApiTokens;
use App\Models\Employee as Employee;

/**
 * {TableComment}
 *
 * @property string $loginUserId
 * @property string $staffCode
 * @property string $displayName
 * @property string $mail
 * @property string $password
 */
class LoginUser extends Authenticatable
{
    // use SoftDeletes;
    use HasApiTokens,HasFactory,Notifiable;

    protected $table = 'LoginUser';
    protected $primaryKey = 'loginUserId';

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

    public function Employee()
    {
        return $this->hasOne(Employee::class, 'staffCode');
    }

    protected $fillable =  ["loginUserId","password"];
    protected $guarded = [];

        /**
     * Get the name of the unique identifier for the user.
     * 主キーの値を取得
     *
     * @return string
     */
    public function getAuthIdentifier() :String
    {
        return $this->loginUserId;
    }

        /**
     * TraitのAuthenticatable.phpのgetメソッドを上書き
     * 指定したカラムからパスワード取得できるようにするため。
     * @return
     */
    public function getAuthPassword()
    {
        return Hash::make($this->password);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [];
    protected $dates = [
        
    ];
    protected $casts = [
        'loginUserId' => 'string',
        'staffCode' => 'string',
        'displayName' => 'string',
        'mail' => 'string',
        'password' => 'string',
    ];
}
