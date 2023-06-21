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
use App\Http\Controllers\UserClientController;
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

// For EzKafe App
// get all categories
Route::get('/categories', [CategoriesController::class, 'index']);
// get all products
Route::get('/products', [ProductsController::class, 'index']);
// get all measurements
Route::get('/measurements', [MeasurementsController::class, 'index']);
// get all ingredients
Route::get('/ingredients', [IngredientsController::class, 'index']);
// get all types
Route::get('/types', [TypesController::class, 'index']);
// get all orders
Route::get('/orders', [OrdersController::class, 'index']);

// get specific ingredient
Route::get('/ingredients/{id}', [IngredientsController::class, 'show']);
// get specific types
Route::get('/types/{id}', [TypesController::class, 'show']);
// get specific order
Route::get('/order/{id}', [OrdersController::class, 'show']);
// get specific custom order
Route::get('/order/custom/{id}', [OrdersController::class, 'getCustomOrder']);
// get specific product
Route::get('/product/{id}', [ProductsController::class, 'getProduct']);
// get specific product ingredient
Route::get('/product_ingredients/{id}', [ProductsController::class, 'getProductIngredients']);
// get top products from order
Route::get('/products/ordered', [ProductsController::class, 'getProductOrdered']);

// Categories
Route::post('/category/create', [CategoriesController::class, 'create']);
Route::put('/category/{id}', [CategoriesController::class, 'update']);
Route::delete('/category/{category}', [CategoriesController::class, 'destroy']);
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

Route::post('/product/store', [ProductsController::class, 'store']);
Route::put('/product/{id}', [ProductsController::class, 'edit']);
Route::delete('/product/{product}', [ProductsController::class, 'delete']);
// Client Users
Route::get('/user/users', UserListsComponent::class)->name('user.users');
Route::post('/user/user/create', [UserListsComponent::class, 'create'])->name('user.user.create');
Route::put('/user/user/{id}', [UserListsComponent::class, 'update'])->name('user.user.update');
Route::delete('/user/user/{user}', [UserListsComponent::class, 'destroy'])->name('user.user.destroy');
// Orders
Route::get('/user/orders', [UserListsComponent::class, 'index']);
Route::post('/user/order/store', [UserListsComponent::class, 'edit']);
Route::put('/user/order/{id}', [UserListsComponent::class, 'update']);
Route::delete('/user/order/{order}', [UserListsComponent::class, 'delete']);
// For Admin Accounts
Route::get('/user/accounts', UserAdminAccountsComponent::class)->name('user.accounts');
Route::post('/user/account/create', [AccountsController::class, 'create'])->name('user.account.create');
Route::put('/user/account/{id}', [AccountsController::class, 'update'])->name('user.account.update');
Route::delete('/user/account/{user}', [AccountsController::class, 'destroy'])->name('user.account.destroy');
// FAQs
Route::get('/user/faqs', UserFAQsComponent::class);
// Protected routes
Route::group(['middleware' => ['api']], function () {
    // create order
    Route::post('/order/create', [OrdersController::class, 'store']);
    // update order
    Route::put('/order/{id}', [OrdersController::class, 'edit']);
    // create client
    Route::post('/client/create', [UserClientController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
