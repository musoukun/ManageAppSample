<?php


use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageAppAuth\AuthenticatedSessionController as ManageAppAuthenticatedSessionController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeCRUDController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\DatabaseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Laravel Template
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Laravel Template End
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('sample/component', [ComponentsController::class, 'index']); //コンポーネントテスト用
Route::get('/database/auto_coder', [DatabaseController::class, 'auto_coder']);

Route::namespace('manageapp')->prefix('manageapp')->middleware('guest:manageapp')->group(function () {
    Route::get('/login', [ManageAppAuthenticatedSessionController::class, 'create'])->name('manageapp.login');
    Route::post('/login', [ManageAppAuthenticatedSessionController::class, 'store']);
});

// manageapp
Route::namespace('manageapp')->prefix('manageapp')->middleware('auth:manageapp')->group(function () {

    //社員検索
    Route::get('employee/', [EmployeeController::class, 'index'])->name('manageapp');

    // paginationのためのgetで検索データ表示
    Route::get('employee/search', [EmployeeController::class, 'search'])->name('manageapp.employee.search');
    Route::post('employee/search', [EmployeeController::class, 'search'])->name('manageapp.employee.search');

    // 社員情報照会
    Route::get('employee/search/{staffCode?}/', [EmployeeController::class, 'select'])->name('manageapp.employee.select');

    // 社員登録
    Route::get('employee/create', [EmployeeController::class, 'create']);
    Route::post('employee/create', [EmployeeCRUDController::class, 'insert'])->name('manageapp.employee.insert');
    Route::get('employee/edit/{staffCode?}/', [EmployeeController::class, 'edit'])->name('manageapp.employee.edit');

    Route::post('employee/update/{staffCode?}/', [EmployeeCRUDController::class, 'update'])->name('manageapp.employee.update');

    // 社員データ削除
    Route::get('employee/delete', [EmployeeCRUDController::class, 'delete'])->name('manageapp.employee.delete');

    Route::post('logout', [ManageAppAuthenticatedSessionController::class, 'destroy'])->name('manageapp.logout');
});




Route::get('/search', [SearchController::class, 'index']);

Route::post('/search', [SearchController::class, 'getColumns']);
Route::post('/search/results', [SearchController::class, 'results']);

require __DIR__ . '/auth.php';//ルーティング情報を別のファイルに分割
