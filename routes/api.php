<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoalsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// global routes defination
// Route::resource('products', ProductController::class);

// Public routes
// [users]
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// [products]
//Route::get('/products', [ProductController::class, 'index']);
//Route::get('/products/{id}', [ProductController::class, 'show']);
//Route::get('/products/search/{name}', [ProductController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // [users]
    Route::post('/logout', [AuthController::class, 'logout']);

    // [products]
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/search/{name}', [ProductController::class, 'search']);

    // [goals]
    Route::get('/goals', [ProductController::class, 'index']);
    Route::get('/goals/{id}', [ProductController::class, 'show']);
    Route::post('/add-goal', [GoalsController::class, 'store']);
    Route::put('/update-goal/{id}', [ProductController::class, 'update']);
    Route::delete('/delete-goal/{id}', [ProductController::class, 'destroy']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('/products', function () {
//     return Products::create([
//         'name' => 'Product One',
//         'slug' => 'product-one',
//         'description' => 'This is product one',
//         'name' => 'Product one',
//         'price' => '99.99',
//     ]);
// });


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
