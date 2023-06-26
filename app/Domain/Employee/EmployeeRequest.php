<?php

declare(strict_types=1);

namespace App\Domain\Employee;

use App\Common\Base\BaseFormRequest;

/**
 * EmployeeRequest
 * 画面ごと独自のRequestクラス（Validation定義を記載）
 * @todo
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Request
 * @package App\UseCase\Employee;
 */
final class EmployeeRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * ログイン処理を実装した際はここでログインチェックを行う。
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            "staffFirstName" => ["required_input", "string", "max:30"],
            "staffLastName" => ["required_input", "string", "max:30"],
            "staffFirstNameKana" => ["required_input", "string", "hiragana", "max:30"],
            "staffLastNameKana" => ["required_input", "string", "hiragana", "max:30"],
            "sex" => ["required_input"],
            "departmentCode" => ["required_input"],
            "travelCost" => ["max:200"],
            "postcode" => ["digits:7"],
            "address" => ["max:200"],
            "tel" => ["max:21"],
            "mail" => ["email","max:254"],
            "remark" => ["max:1000"],
        ];
    }

    public function attributes()
    {
        return [
            'staffFirstName'   => '氏名：姓',
            'staffLastName'   => '氏名：名',
            'staffFirstNameKana' => '氏名ふりがな：姓',
            'staffLastNameKana' => '氏名ふりがな：名',
            'sex' =>  '性別',
            'trafficCost' =>  '交通費',
            'departmentCode' =>  '部署',
            'postcode' =>  '郵便番号',
            'tel' =>  '電話番号',
            'address' =>  '住所',
            'mail' =>  'メールアドレス',
            'remark' =>  '備考',
            
        ];
    }

    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // $validator->sometimes('staffFirstName', 'required_input|max:30', function ($input) {
        //     return $this->is_nullorempty($input->staffFirstName);
        // });

        // $validator->sometimes('staffFirstNameKana', 'required', function ($input) {
        //     return $this->is_nullorempty($input->staffFirstNameKana);
        // });
    }
}
