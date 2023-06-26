<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ひらがな
        Validator::extend("hiragana", function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            return preg_match("/^[ぁ-ん]+/u", $value);
        });

        // カタカナ
        Validator::extend("katakana", function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            return preg_match("/^[ア-ン゛゜ァ-ォャ-ョー]+/u", $value);
        });

        // テキストの必須入力
        Validator::extend("required_input", function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            return $value !== null;
        });
    }
}
