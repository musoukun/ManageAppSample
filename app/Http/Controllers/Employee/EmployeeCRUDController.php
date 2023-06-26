<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Domain\Employee\EmployeeService;
use Illuminate\Http\Request;
use App\Domain\Employee\EmployeeRequest;
use Illuminate\Http\Response;
use App\Domain\Employee\EmployeeEntity;
use App\Domain\Employee\EmployeeRepository;

/**
 * Employee画面Controller
 *
 * @todo パッケージ間の依存関係は、できるだけ疎結合にしたい
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Controller
 * @package App\Http\Controllers\Controller
 *
 */
class EmployeeCRUDController extends Controller
{
    /**
     * EmployeeController __construct.
     * 検索フォームのデータ取得
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->formData = $request;
    }

    /**
     * EmployeeController __construct.
     * formrequestを通してからEntityを扱いたいため、コンストラクタの代わりとなるメソッドを作成
     * @param \Illuminate\Http\Request  $request
     */
    public function init()
    {
        //型の保証
        $this->inputData = new EmployeeEntity($this->formData);
        //業務処理ロジック
        $this->EmployeeService = new EmployeeService($this->inputData);
    }

    /**
     * Employee登録
     * リクエストの書き方1
     * @param \App\Domain\Employee\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     * @todo このメソッドに到達したときに、FormRequest内のバリデーションが実行されます。
     * このリクエストパラメータを、「このメソッドで編集して」扱う方法がこのやり方です。
     */
    public function insert(EmployeeRequest $request)
    {
        // 初期セット
        $this->init();
        // 登録処理
        $newStaffCode = $this->EmployeeService->insert();

        return redirect("manageapp/employee/edit/" . $newStaffCode)
            ->with("message", '登録が完了しました');
    }

    /**
     * Employee編集
     * @param \App\Domain\Employee\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     * @todo バリデーションの中で、RequestをFormRequestに置き換えています。
     */
    public function update(EmployeeRequest $request)
    {
        // // バリデーションを個別で実行する場合
        // $formRequest = app()->make('App\Domain\Employee\EmployeeRequest');

        // 初期セット
        $this->init();

        // 登録処理
        $this->EmployeeService->update();

        return redirect("manageapp/employee/edit/" . $this->inputData->staffCode)->withInput()
            ->with("message", '変更が完了しました');
    }

    /**
     * Employee編集
     * @param \App\Domain\Employee\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     * @todo バリデーションの中で、RequestをFormRequestに置き換えています。
     */
    public function delete(EmployeeRequest $request)
    {
        // 初期セット
        $this->init();

        // 登録処理
        $this->EmployeeService->delete();

        return redirect("manageapp/employee/search")->withInput()
            ->with("message", 'データを削除しました');
    }
}
