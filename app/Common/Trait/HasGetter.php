<?php
declare(strict_types=1);

namespace App\Common\Trait;

/**
 * 汎用Getterメソッド
 *
 * @access public
 * @author waroshi@gmail.com
 * @copyright musoukun
 * @category Trait
 * @package none
 *
 */
trait HasGetter
{
    public function __call(string $name, array $arguments)
    {
        if (!property_exists(self::class, $name)) {
            if (
                get_parent_class() !== false &&
                method_exists(parent::class, "__call")
            ) {
                // 親クラスが存在し、__callメソッドが定義されている場合
                return parent::__call($name, $arguments);
            }

            throw new BadMethodCallException();
        }

        $reflectionProperty = new \ReflectionProperty(self::class, $name);
        $reflectionAttributes = $reflectionProperty->getAttributes(Get::class);
        if (empty($reflectionAttributes)) {
            // Get Attributes が設定されてたいなかった場合
            throw new \BadMethodCallException();
        }

        return $reflectionProperty->isStatic()
            ? $this::${$name}
            : $this->{$name};
    }
}
