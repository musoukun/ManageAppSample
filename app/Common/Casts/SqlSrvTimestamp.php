<?php

namespace App\Common\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class SqlSrvTimestamp implements CastsAttributes
{
    /**
     * Cast the given value.
     * SQLServerのtimestamp（自動インクリメント）型を扱うためのCastAttributes
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        $prefix = "0x";
        $hexadecimal = bin2hex($value);
        // $serial = decoct(hexdec($prefix . $hexadecimal));
        $serial = $prefix . $hexadecimal;
        return $serial;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        $prefix = "0x";
        $hexadecimal = bin2hex($value);
        // $serial = decoct(hexdec($prefix . $hexadecimal));
        $serial = $prefix . $hexadecimal;
        return $serial;
    }

}
