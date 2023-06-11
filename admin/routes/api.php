<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\FaqsController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\OrdersController;

use App\Http\Livewire\User\UserCategoriesComponent;
use App\Http\Livewire\User\UserTypesComponent;
use App\Http\Livewire\User\UserMeasurementsComponent;
use App\Http\Livewire\User\UserIngredientsComponent;
use App\Http\Livewire\User\UserProductsComponent;
use App\Http\Livewire\User\UserListsComponent;
use App\Http\Livewire\User\UserOrdersComponent;

use App\Http\Livewire\User\UserAdminAccountsComponent;
use App\Http\Livewire\User\UserFAQsComponent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Categories
Route::get('/user/categories', UserCategoriesComponent::class)->name('user.categories');
Route::post('/user/category/create', [CategoriesController::class, 'create'])->name('user.category.create');
Route::put('/user/category/{id}', [CategoriesController::class, 'update'])->name('user.category.update');
Route::delete('/user/category/{category}', [CategoriesController::class, 'destroy'])->name('user.category.destroy');
// Types
Route::get('/user/types', UserTypesComponent::class)->name('user.types');
Route::post('/user/type/create', [TypesController::class, 'create'])->name('user.type.create');
Route::put('/user/type/{id}', [TypesController::class, 'update'])->name('user.type.update');
Route::delete('/user/type/{type}', [TypesController::class, 'destroy'])->name('user.type.destroy');
// Measurements
Route::get('/user/measurements', UserMeasurementsComponent::class)->name('user.measurements');
Route::post('/user/measurement/create', [MeasurementsController::class, 'create'])->name('user.measurement.create');
Route::put('/user/measurement/{id}', [MeasurementsController::class, 'update'])->name('user.measurement.update');
Route::delete('/user/measurement/{measurement}', [MeasurementsController::class, 'destroy'])->name('user.measurement.destroy');
// Ingredients
Route::get('/user/ingredients', UserIngredientsComponent::class)->name('user.ingredients');
Route::post('/user/ingredient/create', [IngredientsController::class, 'create'])->name('user.ingredient.create');
Route::put('/user/ingredient/{id}', [IngredientsController::class, 'update'])->name('user.ingredient.update');
Route::delete('/user/ingredient/{ingredient}', [IngredientsController::class, 'destroy'])->name('user.ingredient.destroy');
// Products
Route::get('/products', [ProductsController::class, 'index'])->name('user.products');
Route::post('/product/create', [ProductsController::class, 'create'])->name('user.product.create');
Route::put('/product/{id}', [ProductsController::class, 'update'])->name('user.product.update');
Route::delete('/product/{product}', [ProductsController::class, 'destroy'])->name('user.product.destroy');
// Client Users
Route::get('/user/users', UserListsComponent::class)->name('user.users');
Route::post('/user/user/create', [UserListsComponent::class, 'create'])->name('user.user.create');
Route::put('/user/user/{id}', [UserListsComponent::class, 'update'])->name('user.user.update');
Route::delete('/user/user/{user}', [UserListsComponent::class, 'destroy'])->name('user.user.destroy');
// Orders
Route::get('/user/orders', UserOrdersComponent::class);
Route::post('/user/order/create', [UserListsComponent::class, 'create'])->name('user.order.create');
Route::put('/user/order/{id}', [UserListsComponent::class, 'update'])->name('user.order.update');
Route::delete('/user/order/{order}', [UserListsComponent::class, 'destroy'])->name('user.order.destroy');
// For Admin Accounts
Route::get('/user/accounts', UserAdminAccountsComponent::class)->name('user.accounts');
Route::post('/user/account/create', [AccountsController::class, 'create'])->name('user.account.create');
Route::put('/user/account/{id}', [AccountsController::class, 'update'])->name('user.account.update');
Route::delete('/user/account/{user}', [AccountsController::class, 'destroy'])->name('user.account.destroy');
// FAQs
Route::get('/user/faqs', UserFAQsComponent::class);
// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
