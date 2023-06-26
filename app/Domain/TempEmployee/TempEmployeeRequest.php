<?php

declare(strict_types=1);

namespace App\Domain\TempEmployee;
use App\Common\Base\BaseFormRequest;

/**
 * TempEmployeeRequest
 * {Comment}
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Request
 * @package App\Domain\TempEmployee;
 */
final class TempEmployeeRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            "スタッフコード" => [],
            "スタッフの名" => [],
            "スタッフの姓" => [],
            "スタッフの名（カナ）" => [],
            "スタッフの姓（カナ）" => [],
            "性別" => [],
            "部門コード" => [],
            "課コード" => [],
            "係コード" => [],
            "会社コード" => [],
            "会社名" => [],
            "契約開始日" => [],
            "契約終了日" => [],
            "契約単価" => [],
            "交通費タイプ" => [],
            "交通費" => [],
            "備考" => []
        ];
    }

    public function attributes()
    {
        return [
            'staffCode'   => 'スタッフコード',
            'staffFirstName'   => 'スタッフの名',
            'staffLastName'   => 'スタッフの姓',
            'staffFirstNameKana'   => 'スタッフの名（カナ）',
            'staffLastNameKana'   => 'スタッフの姓（カナ）',
            'sex'   => '性別',
            'departmentCode'   => '部門コード',
            'sectionCode'   => '課コード',
            'unitCode'   => '係コード',
            'companyCode'   => '会社コード',
            'companyName'   => '会社名',
            'contractFrom'   => '契約開始日',
            'contractTo'   => '契約終了日',
            'contractUnitPrice'   => '契約単価',
            'travelCostType'   => '交通費タイプ',
            'travelCost'   => '交通費',
            'remark'   => '備考'
        ];
    }

    /**
     * 項目の複合的なバリデーション処理を記載
     */
    public function withValidator(\Illuminate\Contracts\Validation\Validator $validator)
    {
    }
}