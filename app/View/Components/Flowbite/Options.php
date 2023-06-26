<?php

namespace App\View\Components\Flowbite;

use Illuminate\View\Component;
use Illuminate\View\View;

class Options extends Component
{
    private string $staffCode;
    // private string $KaisyaCd;

    public function __construct(string $staffCode)
    {
        $this->staffCode = $staffCode;
    }

    public function render()
    {
        return view('components.flowbite.options')
            ->with('staffCode', $this->staffCode);
            //チェック処理サンプル
            // ->with('editable', \Illuminate\Support\Facades\Auth::id() === $this->userId);
    }
}
