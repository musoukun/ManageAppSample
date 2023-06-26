<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Domain\Employee\EmployeeService;
use App\Domain\Employee\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Domain\Employee\EmployeeEntity;
use Illuminate\Database\Eloquent\Collection as Collection;


/**
 * Employee画面Controller
 *
 * @todo パッケージ間の依存関係は、できるだけ疎結合に
 * @access public
 * @author waroshi@gmail.com
 * @copyright  musoukun
 * @category Controller
 * @package App\Http\Controllers\Controller
 *
 */
class EmployeeController extends Controller
{
    /**
     * EmployeeController __construct.
     * 検索フォームのデータ取得
     * @param \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->entity = new EmployeeEntity($request);
        $this->EmployeeService = new EmployeeService($this->entity);
    }

    /**
     * 初期表示
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @todo compactに入れる改修はすべき
     */
    public function index()
    {
        $title = "社員検索";
        return view("manageapp.employee.search",  compact('title'))
            ->with('request', $this->request);
    }

    /**
     * 検索画面
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $searchDatas = $this->EmployeeService->search(2);
        $title = "社員検索";

        return view('manageapp.employee.search', compact('searchDatas', 'title'))
            ->with('request', $this->request);
    }

    /**
     * データ照会
     * @return \Illuminate\Http\Response
     */
    public function select()
    {
        $selectData = $this->EmployeeService->select($this->entity->staffCode);
        $title = '社員情報照会';

        return view("manageapp.employee.select", compact('selectData', 'title'))
            ->with('request', $this->request);
    }

    /**
     * 新規登録画面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = '社員情報登録';
        return view("manageapp.employee.create", compact('title'))
            ->with('request', $this->request);
    }

    /**
     * 編集画面
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $selectData = $this->EmployeeService->select($this->entity->staffCode);
        $title = '社員情報編集';

        return view("manageapp.employee.edit", compact('selectData', 'title'))
            ->with('request', $this->request);
    }
}
