<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\VendingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdsController;

use App\Http\Controllers\AccountsController;

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserDashboardComponent;

use App\Http\Livewire\IndexComponent;
use App\Http\Livewire\HomeComponent;

use App\Http\Livewire\User\VendingComponent;
use App\Http\Livewire\User\VendingListComponent;
use App\Http\Livewire\User\VendingProductComponent;
use App\Http\Livewire\User\EditVendingComponent;
use App\Http\Livewire\User\ProductComponent;
use App\Http\Livewire\User\ProductListComponent;
use App\Http\Livewire\User\EditProductComponent;
use App\Http\Livewire\User\AdsComponent;
use App\Http\Livewire\User\AdsListComponent;
use App\Http\Livewire\User\EditAdsComponent;
use App\Http\Livewire\User\ReportComponent;
use App\Http\Livewire\User\ProductCategoryComponent;
use App\Http\Livewire\User\ChangePasswordComponent;

use App\Http\Livewire\User\UserAnalyticsComponent;
use App\Http\Livewire\User\UserIngredientsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserFAQsComponent;
use App\Http\Livewire\User\UserNotificationsComponent;
use App\Http\Livewire\User\UserAdminAccountsComponent;

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

Route::group(['middleware' => ['auth', 'active_user']], function() {
    Route::get('/', 'HomeController@index')->name('home');
    // ... Any other routes that are accessed only by non-blocked user
});

Route::get('/', [HomeController::class, 'checkUserType'])->name('dashboard');

// For Change Password
Route::get('create', [ChangePasswordController::class, 'create']);
Route::post('user/update-password', [ChangePasswordController::class, 'updatePassword']);

// For User or Customer
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/analytics', UserAnalyticsComponent::class);
    Route::get('/user/ingredients', UserIngredientsComponent::class);
    Route::get('/user/orders', UserOrdersComponent::class);
    Route::get('/user/faqs', UserFAQsComponent::class);
    Route::get('/user/notifications', UserNotificationsComponent::class);
    Route::get('/user/accounts', UserAdminAccountsComponent::class)->name('user.accounts');

    Route::post('/user/account/create', [AccountsController::class, 'create'])->name('user.account.create');
    Route::put('/user/account/{id}', [AccountsController::class, 'update'])->name('user.account.update');
    Route::delete('/user/account/{user}', [AccountsController::class, 'destroy'])->name('user.account.destroy');
});

// For Admin
// Route::prefix('admin')->middleware('auth')->group(function() {
//     //
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});
