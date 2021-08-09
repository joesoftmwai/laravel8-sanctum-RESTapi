<?php

use App\Http\Controllers\ProductController;
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

Route::resource('products', ProductController::class);

Route::get('/products/search/{name}', [ProductController::class, 'search']);

// Route::get('/products', [ProductController::class, 'index']);
// Route::post('/products', [ProductController::class, 'store']);
// Route::get('/products/{id}', [ProductController::class, 'show']);


// Route::post('/products', function () {
//     return Products::create([
//         'name' => 'Product One',
//         'slug' => 'product-one',
//         'description' => 'This is product one',
//         'name' => 'Product one',
//         'price' => '99.99',
//     ]);
// });


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
