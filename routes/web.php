<?php

use Illuminate\Support\Facades\Route;
//laravel8必須先 use controller
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LunchController;
use App\Http\Controllers\LunchListController;
use App\Http\Controllers\LunchOrderController;
use App\Http\Controllers\LunchSetupController;
use App\Http\Controllers\LunchSpecialController;
use App\Http\Controllers\LunchStuController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//gsuite登入
Route::get('sms_login/{action?}', [LoginController::class, 'sms_login'])->name('sms_login');
Route::post('g_auth', [LoginController::class, 'g_auth'])->name('g_auth');

//認證圖片
Route::get('pic/{d?}', [HomeController::class, 'pic'])->name('pic');

//下載storage裡public的檔案


Route::group(['middleware' => 'auth'], function () {
    //登出
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //結束模擬
    Route::get('sims/impersonate_leave', [SimulationController::class, 'impersonate_leave'])->name('sims.impersonate_leave');


    //午餐系統
    Route::get('lunches/{lunch_order_id?}', [LunchController::class, 'index'])->name('lunches.index');
    Route::post('lunches', [LunchController::class, 'store'])->name('lunches.store');
    Route::patch('lunches', [LunchController::class, 'update'])->name('lunches.update');

    Route::get('lunch_setup', [LunchSetupController::class, 'index'])->name('lunch_setups.index');
    Route::get('lunch_setup/create', [LunchSetupController::class, 'create'])->name('lunch_setups.create');
    Route::post('lunch_setup/store', [LunchSetupController::class, 'store'])->name('lunch_setups.store');
    Route::get('lunch_setup/{lunch_setup}/edit', [LunchSetupController::class, 'edit'])->name('lunch_setups.edit');
    Route::patch('lunch_setup/{lunch_setup}/update', [LunchSetupController::class, 'update'])->name('lunch_setups.update');
    Route::delete('lunch_setup/{lunch_setup}/destroy', [LunchSetupController::class, 'destroy'])->name('lunch_setups.destroy');
    Route::get('lunch_setup/{path}/{id}/del_file', [LunchSetupController::class, 'fel_file'])->name('lunch_setups.del_file');
    Route::post('lunch_setup/place_add', [LunchSetupController::class, 'place_add'])->name('lunch_setups.place_add');
    Route::patch('lunch_setup/{lunch_place}/place_update', [LunchSetupController::class, 'place_update'])->name('lunch_setups.place_update');
    Route::post('lunch_setup/factory_add', [LunchSetupController::class, 'factory_add'])->name('lunch_setups.factory_add');
    Route::patch('lunch_setup/{lunch_factory}/factory_update', [LunchSetupController::class, 'factory_update'])->name('lunch_setups.factory_update');

    Route::get('lunch_orders/index', [LunchOrderController::class, 'index'])->name('lunch_orders.index');
    Route::get('lunch_orders/{semester}/create', [LunchOrderController::class, 'create'])->name('lunch_orders.create');
    Route::post('lunch_orders/store', [LunchOrderController::class, 'store'])->name('lunch_orders.store');
    Route::get('lunch_orders/{semester}/edit', [LunchOrderController::class, 'edit'])->name('lunch_orders.edit');
    Route::get('lunch_orders/{lunch_order}/edit_order', [LunchOrderController::class, 'edit_order'])->name('lunch_orders.edit_order');
    Route::patch('lunch_orders/{lunch_order}/order_save', [LunchOrderController::class, 'order_save'])->name('lunch_orders.order_save');
    Route::patch('lunch_orders/update', [LunchOrderController::class, 'update'])->name('lunch_orders.update');

    Route::get('lunch_specials/index', [LunchSpecialController::class, 'index'])->name('lunch_specials.index');
    Route::get('lunch_specials/one_day', [LunchSpecialController::class, 'one_day'])->name('lunch_specials.one_day');
    Route::post('lunch_specials/one_day_store', [LunchSpecialController::class, 'one_day_store'])->name('lunch_specials.one_day_store');
    Route::get('lunch_specials/late_teacher', [LunchSpecialController::class, 'late_teacher'])->name('lunch_specials.late_teacher');
    Route::post('lunch_specials/late_teacher_show', [LunchSpecialController::class, 'late_teacher_show'])->name('lunch_specials.late_teacher_show');
    Route::post('lunch_specials/late_teacher_store', [LunchSpecialController::class, 'late_teacher_store'])->name('lunch_specials.late_teacher_store');
    Route::get('lunch_specials/teacher_change_month', [LunchSpecialController::class, 'teacher_change_month'])->name('lunch_specials.teacher_change_month');
    Route::post('lunch_specials/teacher_change_month_show', [LunchSpecialController::class, 'teacher_change_month_show'])->name('lunch_specials.teacher_change_month_show');
    Route::post('lunch_specials/teacher_update_month', [LunchSpecialController::class, 'teacher_update_month'])->name('lunch_specials.teacher_update_month');
    Route::get('lunch_specials/teacher_change', [LunchSpecialController::class, 'teacher_change'])->name('lunch_specials.teacher_change');
    Route::post('lunch_specials/teacher_change_store', [LunchSpecialController::class, 'teacher_change_store'])->name('lunch_specials.teacher_change_store');
    Route::get('lunch_specials/bad_factory', [LunchSpecialController::class, 'bad_factory'])->name('lunch_specials.bad_factory');
    Route::post('lunch_specials/bad_factory2', [LunchSpecialController::class, 'bad_factory2'])->name('lunch_specials.bad_factory2');
    Route::post('lunch_specials/bad_factory3', [LunchSpecialController::class, 'bad_factory3'])->name('lunch_specials.bad_factory3');
    Route::get('lunch_specials/add7', [LunchSpecialController::class, 'add7'])->name('lunch_specials.add7');
    Route::post('lunch_specials/store7', [LunchSpecialController::class, 'store7'])->name('lunch_specials.store7');

    Route::get('lunch_lists/index', [LunchListController::class, 'index'])->name('lunch_lists.index');
    Route::get('lunch_lists/more_list_factory/{lunch_order_id}/{factory_id}', [LunchListController::class, 'more_list_factory'])->name('lunch_lists.more_list_factory');
    Route::get('lunch_lists/every_day/{lunch_order_id?}', [LunchListController::class, 'every_day'])->name('lunch_lists.every_day');
    Route::get('lunch_lists/teacher_money_print/{lunch_order_id}', [LunchListController::class, 'teacher_money_print'])->name('lunch_lists.teacher_money_print');
    Route::get('lunch_lists/call_money/{lunch_order_id}', [LunchListController::class, 'call_money'])->name('lunch_lists.call_money');
    Route::get('lunch_lists/get_money/{lunch_order_id}', [LunchListController::class, 'get_money'])->name('lunch_lists.get_money');
    Route::get('lunch_lists/all_semester', [LunchListController::class, 'all_semester'])->name('lunch_lists.all_semester');
    Route::post('lunch_lists/semester_print', [LunchListController::class, 'semester_print'])->name('lunch_lists.semester_print');
});

//系統管理員及學校管理員
Route::group(['middleware' => 'admin'], function () {
});
//系統管理員
Route::group(['middleware' => 'system_admin'], function () {
});
//學校管理員
Route::group(['middleware' => 'school_admin'], function () {
    //模擬登入
    Route::get('sims/{user}/impersonate', [SimulationController::class, 'impersonate'])->name('sims.impersonate');

    Route::get('users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/disable', [UserController::class, 'user_disable'])->name('users.disable');
    Route::get('users/teach_api', [UserController::class, 'teach_api'])->name('users.teach_api');
    Route::post('users/api_pull', [UserController::class, 'api_pull'])->name('users.api_pull');
    Route::get('users/teach_excel', [UserController::class, 'teach_excel'])->name('users.teach_excel');
    Route::post('api/store', [UserController::class, 'api_store'])->name('users.api_store');
    Route::post('excel/import', [UserController::class, 'excel_import'])->name('users.excel_import');
    Route::delete('api/destroy/{school_api}', [UserController::class, 'api_destroy'])->name('users.api_destroy');

    Route::get('users/{semester}/show_class/{student_year?}/{student_class?}', [UserController::class, 'show_class'])->name('users.show_class');

    Route::get('module/index', [HomeController::class, 'module_index'])->name('module.index');
    Route::post('module/store', [HomeController::class, 'module_store'])->name('module.store');
    Route::get('module/{school_power}/delete', [HomeController::class, 'module_delete'])->name('module.delete');
});

include('sport_meeting.php');
