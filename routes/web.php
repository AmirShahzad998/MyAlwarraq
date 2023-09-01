<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SummaryController;
use App\Models\JobOrder;
use Illuminate\Support\Facades\Storage;

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

Route::get('optimize', function(){
    Artisan::call('optimize:clear');
    return 'Your application has been optimized';
})->name('optimize');

// Route::get('fresh-start', function () {
//     Artisan::call('migrate:fresh --seed');
//     return 'Application Fresh Start has been done';
// })->name('fresh-start');

Route::get('storage-link', function(){
       Artisan::call('storage:link');
        $target = storage_path('app/public');
        $link = $_SERVER['DOCUMENT_ROOT'].'/storage';
        symlink($target, $link);
        return 'Storage Link updated';
    })->name('storage-link');


Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['register' => false]);



Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');


    /**
     * Start User And Role Management
     */
    // Route::resource('user', UserController::class);
    // Route::get('/search/', 'PostsController@search')->name('search');
    // Route::get('/search/', [UserController::class, 'index'])->name('search');
    // Route::get('user/index', [UserController::class, 'index'])->name('user.index');
    // Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    // Route::patch('user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('user/profile/edit', [UserController::class, 'profile_edit'])->name('user.profile.edit');
    Route::patch('user/profile/update', [UserController::class, 'profile_update'])->name('user.profile.update');
    Route::get('change-password', [UserController::class, 'change_password_edit'])->name('change-password.edit');
    Route::patch('change-password', [UserController::class, 'change_password_update'])->name('change-password.update');
    Route::resource('user', UserController::class);
    Route::post('role/sync/permission/{role:name}', [RoleController::class, 'role_sync_permission'])->name('role.sync.permission');
    Route::resource('role', RoleController::class, ['parameters' => [
        'role' => 'role:name'
    ]]);
    Route::resource('permission', PermissionController::class, ['parameters' => [
        'permission' => 'permission:name'
    ]]);
    Route::resource('customer', CustomerController::class, ['parameters' => [
        'customer' => 'customer:slug'
    ]]);
    Route::resource('supplier', SupplierController::class, ['parameters' => [
        'supplier' => 'supplier:slug'
    ]]);
    Route::post('material/type', [MaterialController::class, 'type_store'])->name('type.store');
    Route::delete('material/type/{id}', [MaterialController::class, 'type_delete'])->name('type.destroy');
    Route::get('material/type/{id}', [MaterialController::class, 'show_type'])->name('material.materialType_show');

    Route::resource('material', MaterialController::class, ['parameters' => [
        'material' => 'material:slug'
    ]]);

    // Route::get('purchases', [PurchaseController::class, 'getdata'])->name('purchase.getdata');
    Route::get('purchases', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::resource('purchase', PurchaseController::class, ['parameters' => [
        'purchase' => 'purchase:slug'
    ]])->except('index');

    Route::get('/dashboard/purchases/by-date', [PurchaseController::class, 'index'])->name('purchase.by-date');

    Route::get('job-order/{jobOrder:slug}/estimate', [JobOrderController::class, 'estimate'])->name('job-order.estimate');
    Route::get('job-order/{jobOrder:slug}/actual', [JobOrderController::class, 'actual'])->name('job-order.actual');
    Route::get('job-orders', [JobOrderController::class, 'index'])->name('job-order.index');
    Route::resource('job-order', JobOrderController::class, ['parameters' => [
        'job-order' => 'jobOrder:slug'
    ]])->except('index');

    Route::get('/dashboard/job-orders/by-date', [JobOrderController::class, 'index'])->name('job-orders.by-date');


    Route::get('image-upload', [ SettingController::class, 'imageUpload' ])->name('setting.general');
    Route::post('/image/upload', [SettingController::class, 'general'])->name('setting.general');
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    // Route::patch('setting', [SettingController::class, 'general'])->name('setting.general');
    Route::get('/logo/{filename}', [SettingController::class, 'show'])->name('setting.show');
Route::post('/generalSetting', [SettingController::class, 'generalSetting'])->name('GeneralSetting');
    Route::get('summary/{month?}', [SummaryController::class, 'index'])->name('summary.index');
    Route::get('summary/by-date', [SummaryController::class, 'index'])->name('summary.by-date');


    // Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');


    // Route::get('users-list', 'UsersController@usersList');
    Route::get('users-list', [PurchaseController::class,'usersList']);
});
