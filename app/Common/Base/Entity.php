<?php

declare(strict_types=1);

namespace App\Common\Base;

use App\Common\Trait\ObjectTrait;
use App\Common\Trait\StringTrait;
use Illuminate\Http\Request;

/**
 * エンティティ基底クラス
 */
class Entity
{
    use StringTrait, ObjectTrait;

    /**
     * @var array キャストルール
     */
    protected $casts = [];

    /**
     * RequestデータをCastします
     *
     * @todo キャストできない型指定のパターンの考慮をしていない
     * @param Entity $entity
     * @return Request $request
     */
    public function requestCast(Request $request): Request
    {
        if (empty($this->casts)) {
            return $request;
        }

        foreach ($this->casts as $key => $cast) {
            $castPattern = $cast;
            $request->merge([$key => $request->$castPattern($key)]);
        }
        return $request;
    }

    /**
     * Create a new entity instance.
     *
     * @return void
     */
    public function __construct(Object $obj){
        if ($obj instanceof Request) {
            $obj = $this->requestCast($obj);
        }
    }

    /**
     * エンティティの等価性を検証します．
     *
     * @param Entity $entity
     * @return bool
     */
    // public function equals(Entity $entity): bool
    // {
    //     return ($entity instanceof $this || $this instanceof $entity) // エンティティのデータ型の等価性
    //         && $this->id->equals($entity->id); // IDオブジェクトの等価性
    // }

    // /**
    //  * 汎用getter
    //  *
    //  * @param string $name
    //  * @param array $arguments
    //  * @return object
    //  */
    // public function __call(string $name, array $arguments)
    // {
    //     if (!property_exists(self::class, $name)) {
    //         // プロパティが存在しない場合にReflectionProperty をインスタンス化すると
    //         // ReflectionException がスローされるが、サンプルの挙動を分かりやすくするため
    //         // 存在しない場合は事前に null を返すようにしている
    //         return null;
    //     }

    //     $reflectionProperty = new ReflectionProperty(self::class, $name);
    //     $reflectionAttributes = $reflectionProperty->getAttributes(Get::class);
    //     if (empty($reflectionAttributes)) {
    //         // Get Attributes が設定されてたいなかった場合で、こちらもプロパティが存在しない場合と同様
    //         // サンプルの挙動をわかりやすくするためエラーではなく null を返すようにしている
    //         return null;
    //     }

    //     // static プロパティとそうでないプロパティではアクセス方法が違う
    //     return $reflectionProperty->isStatic()
    //         ? $this::${$name}
    //         : $this->{$name};
    // }
}
