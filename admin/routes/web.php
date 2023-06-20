<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangePasswordController;

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\FaqsController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;

use App\Http\Livewire\IndexComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\User\ChangePasswordComponent;

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserDashboardComponent;

use App\Http\Livewire\User\UserAnalyticsComponent;
use App\Http\Livewire\User\UserGraphComponent;
use App\Http\Livewire\User\UserCategoriesComponent;
use App\Http\Livewire\User\UserTypesComponent;
use App\Http\Livewire\User\UserMeasurementsComponent;
use App\Http\Livewire\User\UserIngredientsComponent;
use App\Http\Livewire\User\UserProductsComponent;
use App\Http\Livewire\User\UserListsComponent;
use App\Http\Livewire\User\UserOrdersComponent;

use App\Http\Livewire\User\UserAdminAccountsComponent;
use App\Http\Livewire\User\UserFAQsComponent;
use App\Http\Livewire\User\UserNotificationsComponent;

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
    Route::get('/user/analytics', UserAnalyticsComponent::class)->name('user.analytics');
    Route::get('/user/usergraphs', UserGraphComponent::class)->name('user.usergraph');
    Route::get('/user/ingredients', UserIngredientsComponent::class)->name('user.ingredients');
    Route::get('/user/products', UserProductsComponent::class)->name('user.products');
    Route::get('/user/types', UserTypesComponent::class)->name('user.types');
    Route::get('/user/categories', UserCategoriesComponent::class)->name('user.categories');
    Route::get('/user/measurements', UserMeasurementsComponent::class)->name('user.measurements');
    Route::get('/user/users', UserListsComponent::class)->name('user.users');
    Route::get('/user/orders', UserOrdersComponent::class);
    Route::get('/user/faqs', UserFAQsComponent::class);
    Route::get('/user/notifications', UserNotificationsComponent::class);
    Route::get('/user/accounts', UserAdminAccountsComponent::class)->name('user.accounts');

    // For Category
    Route::post('/user/category/create', [CategoriesController::class, 'create'])->name('user.category.create');
    Route::put('/user/category/{id}', [CategoriesController::class, 'update'])->name('user.category.update');
    Route::delete('/user/category/{user}', [CategoriesController::class, 'destroy'])->name('user.category.destroy');
    // For Type
    Route::post('/user/type/create', [TypesController::class, 'create'])->name('user.type.create');
    Route::put('/user/type/{id}', [TypesController::class, 'update'])->name('user.type.update');
    Route::delete('/user/type/{user}', [TypesController::class, 'destroy'])->name('user.type.destroy');
    // For Measurements
    Route::post('/user/measurement/create', [MeasurementsController::class, 'create'])->name('user.measurement.create');
    Route::put('/user/measurement/{id}', [MeasurementsController::class, 'update'])->name('user.measurement.update');
    Route::delete('/user/measurement/{user}', [MeasurementsController::class, 'destroy'])->name('user.measurement.destroy');
    // For Ingredients
    Route::post('/user/ingredient/create', [IngredientsController::class, 'create'])->name('user.ingredient.create');
    Route::put('/user/ingredient/{id}', [IngredientsController::class, 'update'])->name('user.ingredient.update');
    Route::delete('/user/ingredient/{user}', [IngredientsController::class, 'destroy'])->name('user.ingredient.destroy');
    // For Products
    Route::post('/user/product/create', [ProductsController::class, 'create'])->name('user.product.create');
    Route::put('/user/product/{id}', [ProductsController::class, 'update'])->name('user.product.update');
    Route::delete('/user/product/{id}', [ProductsController::class, 'destroy'])->name('user.product.destroy');
    // For Ordes
    Route::get('/user/orders/top', [UserOrdersComponent::class, 'getTop5'])->name('user.order.top');
    Route::post('/user/order/create', [OrdersController::class, 'create'])->name('user.order.create');
    Route::put('/user/order/{id}', [OrdersController::class, 'update'])->name('user.order.update');
    Route::delete('/user/order/{id}', [OrdersController::class, 'destroy'])->name('user.order.destroy');
    // For Admin Account
    Route::post('/user/account/create', [AccountsController::class, 'create'])->name('user.account.create');
    Route::put('/user/account/{id}', [AccountsController::class, 'update'])->name('user.account.update');
    Route::delete('/user/account/{user}', [AccountsController::class, 'destroy'])->name('user.account.destroy');
    // For FAQs
    Route::post('/user/faq/create', [FaqsController::class, 'create'])->name('user.faq.create');
    Route::put('/user/faq/{id}', [FaqsController::class, 'update'])->name('user.faq.update');
    Route::delete('/user/faq/{user}', [FaqsController::class, 'destroy'])->name('user.faq.destroy');
    // For Client User
    Route::delete('/user/user/{user}', [UserListsComponent::class, 'destroy'])->name('user.user.destroy');
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
