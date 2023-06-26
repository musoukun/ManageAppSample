<?php

declare(strict_types=1);

namespace App\Common\Base;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Trait\ObjectTrait;
use App\Common\Trait\StringTrait;
use Illuminate\Http\Request;


/**
 * FormRequest基底クラス
 */
class BaseFormRequest extends FormRequest
{
    use StringTrait, ObjectTrait;

}
