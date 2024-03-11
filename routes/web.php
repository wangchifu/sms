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
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\LendsController;

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
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('sys', [LoginController::class, 'sys'])->name('sys');
Route::post('sys_auth', [LoginController::class, 'sys_auth'])->name('sys_auth');
Route::get('sys_user', [LoginController::class, 'sys_user'])->name('sys_user');
Route::get('impersonate/{user}', [LoginController::class, 'impersonate'])->name('impersonate');
Route::get('sys_logout', [LoginController::class, 'sys_logout'])->name('sys_logout');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//gsuite登入
Route::get('sms_login/{action?}', [LoginController::class, 'sms_login'])->name('sms_login');
Route::post('g_auth', [LoginController::class, 'g_auth'])->name('g_auth');

//認證圖片
Route::get('pic/{d?}', [HomeController::class, 'pic'])->name('pic');

//下載storage裡public的檔案


//廠商頁面
Route::match(['get', 'post'], 'lunch_lists/factory/{lunch_order_id?}', [LunchListController::class, 'factory'])->name('lunch_lists.factory');
Route::get('lunch_lists/change_factory/', [LunchListController::class, 'change_factory'])->name('lunch_lists.change_factory');


//社團家長頁面
Route::get('clubs/semester_select', [ClubsController::class,'semester_select'])->name('clubs.semester_select');
Route::get('clubs/{semester}/{class_id}/parents_login', [ClubsController::class,'parents_login'])->name('clubs.parents_login');
Route::post('clubs/do_login', [ClubsController::class,'do_login'])->name('clubs.do_login');
Route::get('clubs/parents_do/{class_id}', [ClubsController::class,'parents_do'])->name('clubs.parents_do');
Route::get('clubs/parents_logout', [ClubsController::class,'parents_logout'])->name('clubs.parents_logout');
Route::get('clubs/{class_id}/change_pwd', [ClubsController::class,'change_pwd'])->name('clubs.change_pwd');
Route::patch('clubs/change_pwd_do', [ClubsController::class,'change_pwd_do'])->name('clubs.change_pwd_do');
Route::post('clubs/{student}/get_telephone', [ClubsController::class,'get_telephone'])->name('clubs.get_telephone');
Route::get('clubs/{club}/{class_id}/show_club', [ClubsController::class,'show_club'])->name('clubs.show_club');
Route::get('clubs/{club}/sign_up', [ClubsController::class,'sign_up'])->name('clubs.sign_up');
Route::get('clubs/{club_id}/sign_down', [ClubsController::class,'sign_down'])->name('clubs.sign_down');
Route::get('clubs/{club}/{class_id}/sign_show', [ClubsController::class,'sign_show'])->name('clubs.sign_show');

Route::get('lends/clean/{lend_class_id?}/{this_date?}', [LendsController::class,'index'])->name('lends.clean');
Route::get('lends/list_clean', [LendsController::class,'list_clean'])->name('lends.list_clean');
Route::get('lends/check_order_out_clean/{this_date}/{action}', [LendsController::class,'check_order_out_clean'])->name('lends.check_order_out_clean');

Route::group(['middleware' => 'auth'], function () {
    //登出
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    //結束模擬
    Route::get('sims/impersonate_leave', [SimulationController::class, 'impersonate_leave'])->name('sims.impersonate_leave');


    //午餐系統
    //顯示上傳的圖片
    Route::get('img/{path}', [HomeController::class, 'getImg'])->name('getImg');

    Route::get('lunches/{lunch_order_id?}', [LunchController::class, 'index'])->name('lunches.index');
    Route::post('lunches', [LunchController::class, 'store'])->name('lunches.store');
    Route::patch('lunches', [LunchController::class, 'update'])->name('lunches.update');

    Route::get('lunch_setup', [LunchSetupController::class, 'index'])->name('lunch_setups.index');
    Route::get('lunch_setup/create', [LunchSetupController::class, 'create'])->name('lunch_setups.create');
    Route::post('lunch_setup/store', [LunchSetupController::class, 'store'])->name('lunch_setups.store');
    Route::get('lunch_setup/{lunch_setup}/edit', [LunchSetupController::class, 'edit'])->name('lunch_setups.edit');
    Route::patch('lunch_setup/{lunch_setup}/update', [LunchSetupController::class, 'update'])->name('lunch_setups.update');
    Route::delete('lunch_setup/{lunch_setup}/destroy', [LunchSetupController::class, 'destroy'])->name('lunch_setups.destroy');
    Route::get('lunch_setup/{path}/del_file', [LunchSetupController::class, 'del_file'])->name('lunch_setups.del_file');
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
    Route::get('lunch_lists/every_day_download/{lunch_order_id}', [LunchListController::class, 'every_day_download'])->name('lunch_lists.every_day_download');
    Route::get('lunch_lists/call_money/{lunch_order_id}', [LunchListController::class, 'call_money'])->name('lunch_lists.call_money');
    Route::get('lunch_lists/get_money/{lunch_order_id}', [LunchListController::class, 'get_money'])->name('lunch_lists.get_money');
    Route::get('lunch_lists/all_semester', [LunchListController::class, 'all_semester'])->name('lunch_lists.all_semester');
    Route::post('lunch_lists/semester_print', [LunchListController::class, 'semester_print'])->name('lunch_lists.semester_print');

    Route::get('lunch_stus/index/{lunch_order_id?}/{sample_date?}', [LunchStuController::class, 'index'])->name('lunch_stus.index');
    Route::get('lunch_stus/delete/{lunch_order_id}', [LunchStuController::class, 'delete'])->name('lunch_stus.delete');
    Route::post('lunch_stus/store/{lunch_order_id}', [LunchStuController::class, 'store'])->name('lunch_stus.store');
    Route::post('lunch_stus/change_num', [LunchStuController::class, 'change_num'])->name('lunch_stus.change_num');
    Route::post('lunch_stus/store_ps/{lunch_order}', [LunchStuController::class, 'store_ps'])->name('lunch_stus.store_ps');


    //學生管理
    Route::get('users/stu_index', [UserController::class, 'stu_index'])->name('users.stu_index');
    Route::get('users/teach_excel', [UserController::class, 'teach_excel'])->name('users.teach_excel');
    Route::post('excel/import', [UserController::class, 'excel_import'])->name('users.excel_import');
    Route::get('users/{semester}/show_class/{student_year?}/{student_class?}', [UserController::class, 'show_class'])->name('users.show_class');
    Route::get('users/{semester}/show_disable', [UserController::class, 'show_disable'])->name('users.show_disable');
    Route::get('users/stu_create/{student_class}', [UserController::class, 'stu_create'])->name('users.stu_create');
    Route::post('users/stu_store', [UserController::class, 'stu_store'])->name('users.stu_store');
    Route::get('users/stu_edit/{student}', [UserController::class, 'stu_edit'])->name('users.stu_edit');
    Route::patch('users/stu_update/{student}', [UserController::class, 'stu_update'])->name('users.stu_update');
    Route::get('users/stu_back_pwd/{student}', [UserController::class, 'stu_back_pwd'])->name('users.stu_back_pwd');
    Route::get('users/stu_disable/{student}', [UserController::class, 'stu_disable'])->name('users.stu_disable');


    //社團報名
    Route::get('clubs', [ClubsController::class,'index'])->name('clubs.index');
    Route::get('clubs/semester_create', [ClubsController::class,'semester_create'])->name('clubs.semester_create');
    Route::post('clubs/semester_store', [ClubsController::class,'semester_store'])->name('clubs.semester_store');
    Route::get('clubs/{path}/del_file', [ClubsController::class, 'del_file'])->name('clubs.del_file');
    Route::get('clubs/{semester}/semester_delete', [ClubsController::class,'semester_delete'])->name('clubs.semester_delete');
    Route::get('clubs/{club_semester}/semester_edit', [ClubsController::class,'semester_edit'])->name('clubs.semester_edit');
    Route::patch('clubs/{club_semester}/semester_update', [ClubsController::class,'semester_update'])->name('clubs.semester_update');
    Route::get('clubs/setup/{semester?}', [ClubsController::class,'setup'])->name('clubs.setup');
    Route::get('clubs/{semester}/club_create', [ClubsController::class,'club_create'])->name('clubs.club_create');
    Route::post('clubs/club_store', [ClubsController::class,'club_store'])->name('clubs.club_store');
    Route::post('clubs/club_copy', [ClubsController::class,'club_copy'])->name('clubs.club_copy');
    Route::get('clubs/{club}/club_edit', [ClubsController::class,'club_edit'])->name('clubs.club_edit');
    Route::patch('clubs/{club}/club_update', [ClubsController::class,'club_update'])->name('clubs.club_update');
    Route::get('clubs/{club}/club_delete', [ClubsController::class,'club_delete'])->name('clubs.club_delete');
    Route::get('clubs/{semester}/stu_adm', [ClubsController::class,'stu_adm'])->name('clubs.stu_adm');
    Route::get('clubs/black', [ClubsController::class,'black'])->name('clubs.black');
    Route::get('clubs/{semester}/stu_adm_more/{student_class_id?}', [ClubsController::class,'stu_adm_more'])->name('clubs.stu_adm_more');
    Route::post('clubs/{semester}/stu_import', [ClubsController::class,'stu_import'])->name('clubs.stu_import');
    Route::get('clubs/{semester}/stu_create/{student_class}', [ClubsController::class,'stu_create'])->name('clubs.stu_create');
    Route::post('clubs/{semester}/stu_store', [ClubsController::class,'stu_store'])->name('clubs.stu_store');
    Route::get('clubs/{club_student}/stu_edit/{student_class}', [ClubsController::class,'stu_edit'])->name('clubs.stu_edit');
    Route::patch('clubs/{club_student}/stu_update', [ClubsController::class,'stu_update'])->name('clubs.stu_update');
    Route::get('clubs/{club_student}/stu_delete/{student_class_id}', [ClubsController::class,'stu_delete'])->name('clubs.stu_delete');
    Route::get('clubs/{club_student}/stu_disable/{student_class_id}', [ClubsController::class,'stu_disable'])->name('clubs.stu_disable');
    Route::get('clubs/{club_student}/stu_enable/{student_class_id}', [ClubsController::class,'stu_enable'])->name('clubs.stu_enable');
    Route::get('clubs/{club_student}/stu_backPWD/{student_class_id}', [ClubsController::class,'stu_backPWD'])->name('clubs.stu_backPWD');

    Route::get('clubs/report_situation/{semester?}', [ClubsController::class,'report_situation'])->name('clubs.report_situation');
    Route::get('clubs/report_not_situation/{semester?}', [ClubsController::class,'report_not_situation'])->name('clubs.report_not_situation');
    Route::get('clubs/{semester}/report_situation_download/{class_id}', [ClubsController::class,'report_situation_download'])->name('clubs.report_situation_download');
    Route::get('clubs/{club_register}/report_register_delete', [ClubsController::class,'report_register_delete'])->name('clubs.report_register_delete');
    Route::get('clubs/report_money/{semester?}', [ClubsController::class,'report_money'])->name('clubs.report_money');
    Route::get('clubs/{semester}/{class_id}/report_money_download', [ClubsController::class,'report_money_download'])->name('clubs.report_money_download');
    Route::get('clubs/{semester}/{class_id}/report_money_download2', [ClubsController::class,'report_money_download2'])->name('clubs.report_money_download2');
    Route::get('clubs/{semester}/{class_id}/report_money2_print', [ClubsController::class,'report_money2_print'])->name('clubs.report_money2_print');
    Route::get('clubs/report', [ClubsController::class,'report'])->name('clubs.report');

    Route::post('clubs/store_black', [ClubsController::class,'store_black'])->name('clubs.store_black');
    Route::get('clubs/{club_black}/destroy_black', [ClubsController::class,'destroy_black'])->name('clubs.destroy_black');


//借用系統
    Route::get('lends/index/{lend_class_id?}/{this_date?}', [LendsController::class,'index'])->name('lends.index');
    
    Route::get('lends/list', [LendsController::class,'list'])->name('lends.list');
    Route::get('lends/my_list', [LendsController::class,'my_list'])->name('lends.my_list');
    Route::get('lends/admin/{lend_class_id?}', [LendsController::class,'admin'])->name('lends.admin');
    Route::post('lends/store_class', [LendsController::class,'store_class'])->name('lends.store_class');
    Route::post('lends/update_class/{lend_class}', [LendsController::class,'update_class'])->name('lends.update_class');
    Route::get('lends/delete_class/{lend_class}', [LendsController::class,'delete_class'])->name('lends.delete_class');
    Route::post('lends/store_item', [LendsController::class,'store_item'])->name('lends.store_item');
    Route::get('lends/delete_item/{lend_item}', [LendsController::class,'delete_item'])->name('lends.delete_item');
    Route::get('lends/admin_edit/{lend_item}', [LendsController::class,'admin_edit'])->name('lends.admin_edit');
    Route::post('lends/update_item/{lend_item}', [LendsController::class,'update_item'])->name('lends.update_item');
    Route::get('lends/check_item_num/{lend_item}', [LendsController::class,'check_item_num'])->name('lends.check_item_num');
    Route::get('lends/check_order_out/{this_date}/{action}', [LendsController::class,'check_order_out'])->name('lends.check_order_out');
    Route::post('lends/order', [LendsController::class,'order'])->name('lends.order');
    Route::get('lends/delete_my_order/{lend_order}', [LendsController::class,'delete_my_order'])->name('lends.delete_my_order');
    Route::get('lends/delete_order/{lend_order}', [LendsController::class,'delete_order'])->name('lends.delete_order');
    Route::post('lends/update_other_order/{lend_order}', [LendsController::class,'update_other_order'])->name('lends.update_other_order');
    Route::post('store_line_notify', [LendsController::class,'store_line_notify'])->name('store_line_notify');


    //運動會報名
    Route::get('sports/index', [SportsController::class,'index'])->name('sports.index');
    Route::get('sports/setup', [SportsController::class,'setup'])->name('sports.setup');
    Route::get('sports/setup/action_create', [SportsController::class,'action_create'])->name('sports.setup.action_create');
    Route::post('sports/setup/action_store', [SportsController::class,'action_store'])->name('sports.setup.action_store');
    Route::get('sports/setup/action_show', [SportsController::class,'action_show'])->name('sports.setup.action_show');
    Route::get('sports/setup/action_edit/{action}', [SportsController::class,'action_edit'])->name('sports.setup.action_edit');
    Route::patch('sports/setup/action/{action}/update', [SportsController::class,'action_update'])->name('sports.setup.action_update');
    Route::get('sports/setup/action_disable/{action}', [SportsController::class,'action_disable'])->name('sports.setup.action_disable');
    Route::get('sports/setup/action_destroy/{action}', [SportsController::class,'action_destroy'])->name('sports.setup.action_destroy');
    Route::get('sports/setup/item/{select_action}', [SportsController::class,'item_index'])->name('sports.setup.item_index');
    Route::get('sports/setup/item/{action}/create', [SportsController::class,'item_create'])->name('sports.setup.item_create');
    Route::post('sports/setup/item/store', [SportsController::class,'item_store'])->name('sports.setup.item_store');
    Route::post('sports/setup/item/import', [SportsController::class,'item_import'])->name('sports.setup.item_import');    
    Route::get('sports/setup/item/{item}/edit', [SportsController::class,'item_edit'])->name('sports.setup.item_edit');
    Route::patch('sports/setup/item/{item}/update', [SportsController::class,'item_update'])->name('sports.setup.item_update');    
    Route::get('sports/setup/item/{item}/disable', [SportsController::class,'item_disable'])->name('sports.setup.item_disable');
    Route::get('sports/setup/item/{item}/destroy', [SportsController::class,'item_destroy'])->name('sports.setup.item_destroy');    



    Route::get('sports/setup/action_set_number', [SportsController::class,'action_set_number'])->name('sports.setup.action_set_number');
    Route::get('sports/setup/action_set_number_null', [SportsController::class,'action_set_number_null'])->name('sports.setup.action_set_number_null');
    
    Route::get('sports/sign_up', [SportsController::class,'sign_up'])->name('sports.sign_up');
    Route::get('sports/list', [SportsController::class,'list'])->name('sports.list');
    Route::get('sports/score', [SportsController::class,'score'])->name('sports.score');
});

//系統管理員及學校管理員及任一管理員
Route::group(['middleware' => 'admin'], function () {
    Route::post('module/store_name', [HomeController::class, 'module_store_name'])->name('module.store_name');
    Route::get('module/{path}/del_name', [HomeController::class, 'module_del_name'])->name('module.del_name');    
    //模擬登入
    Route::get('sims/{user}/impersonate', [SimulationController::class, 'impersonate'])->name('sims.impersonate');
});
//系統管理員
Route::group(['middleware' => 'system_admin'], function () {
});
//學校管理員
Route::group(['middleware' => 'school_admin'], function () {    

    Route::get('users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/disable', [UserController::class, 'user_disable'])->name('users.disable');
    Route::get('users/teach_api', [UserController::class, 'teach_api'])->name('users.teach_api');
    Route::post('users/api_pull', [UserController::class, 'api_pull'])->name('users.api_pull');
    Route::post('api/store', [UserController::class, 'api_store'])->name('users.api_store');

    Route::delete('api/destroy/{school_api}', [UserController::class, 'api_destroy'])->name('users.api_destroy');

    Route::get('module/index', [HomeController::class, 'module_index'])->name('module.index');
    Route::post('module/store', [HomeController::class, 'module_store'])->name('module.store');    
    Route::get('module/{school_power}/delete', [HomeController::class, 'module_delete'])->name('module.delete');
});

include('sport_meeting.php');
