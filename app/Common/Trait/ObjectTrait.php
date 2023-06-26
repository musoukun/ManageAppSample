<?php
declare(strict_types=1);
namespace App\Common\Trait;

/**
 * オブジェクトの判定や操作を行う汎用的なメソッドを定義します
 *
 * @todo Utilityクラス事態が悪であるので、真偽だけを判断し
 *       絶対に状態は持たないを徹底すること。
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Trait
 * @package none
 *
 */
trait ObjectTrait
{
    /**
     * 少し高度なNullチェック
     * nullはtrue, "" も true, 0 や "0" は false, " "（空白） は false.
     * @param mixed チェックしたいobject
     * @return boolean チェック結果
     * @todo パラメータmixedでもよい？
     */
    public function is_nullorempty(mixed $obj): bool
    {
        if ($obj === 0 || $obj === "0") {
            return false;
        }

        return empty($obj);
    }
}
