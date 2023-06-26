<?php

namespace App\View\Components\flowbite;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Department;
use App\Models\Code;

class CodeSelect extends Component
{
    /** @var string **/
    public object $datas;

    /** @var string **/
    public string $codeKey;

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(string $codeKey)
    {

        $this->codeKey = $codeKey;
        if ($codeKey == "departmentCode") {
            $this->datas = Department::groupby("departmentCode","departmentName")
                ->select(
                    "departmentCode",
                    "departmentName",
                )->orderby("departmentCode", "ASC")
                ->get();
        } else {
            $this->datas = Code::getCodeDatas($codeKey);
        }
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.flowbite.code-select');
    }
}
