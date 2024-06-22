<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SalesContoller;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/
// Rutas para el inicio de sesión y cierre de sesión
Route::post('/registro',[AuthController::class,'storeUser']);
Route::post('/login', [AuthController::class, 'login']);
//
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/active-users', [AuthController::class, 'getActiveUsers']);
    Route::put('/users/{user}', [AuthController::class, 'update']);
});
Route::get('/rol', [RolController::class, 'indexRole']);
Route::post('/Aggrol', [RolController::class, 'storeRole']);
Route::get('/roles/{role}', [RolController::class, 'show']);


///
Route::get('/modulo', [ModuleController::class, 'indexmodule']);
Route::post('/crear_modulo', [ModuleController::class, 'create_module']);
///Submodulo
Route::get('/submodulo', [ModuleController::class, 'indexsubmodulos']);
Route::post('/crear_submodulo', [ModuleController::class, 'create_submodule']);
//////Productos
Route::get('/productos/{product}', [ProductoController::class, 'showProduct']);
Route::post('/AggProduct', [ProductoController::class, 'storeProduct']);
Route::get('/products/search', [ProductoController::class, 'search']);
Route::get('/ListaProduct', [ProductoController::class, 'indexProduct']);
Route::get('/products/{sku}', [ProductoController::class, 'searchBySku']);
Route::get('/categories', [ProductoController::class, 'indexCat']);
Route::post('/categories', [ProductoController::class, 'storeCat']);
Route::get('/categories/{category}', [ProductoController::class, 'showCat']);
Route::put('/categories/{id}', [ProductoController::class, 'updateCat']);
Route::delete('/categories/{id}', [ProductoController::class, 'destroyCat']);
Route::patch('/categories/{id}/deactivate', [ProductoController::class, 'deactivateCat']);
//Customer
Route::get('/customers', [CustomersController::class, 'index']);
Route::post('/Regcustomers', [CustomersController::class, 'store']);
Route::get('/customers/{customer}', [CustomersController::class, 'show']);
Route::put('/customers/{customer}', [CustomersController::class, 'update']);
Route::delete('/customers/{customer}', [CustomersController::class, 'destroy']);
////
Route::get('/customer_types', [CustomersController::class, 'indexcustotype']);
Route::post('/customer_types', [CustomersController::class, 'storecustomertype']);
Route::get('/customer_types/{customerType}', [CustomersController::class, 'showCustypes']);
Route::put('/customer_types/{customerType}', [CustomersController::class, 'updateCustType']);
Route::delete('/customer_types/{customerType}', [CustomersController::class, 'destroyCustype']);
Route::put('/customer_types/{customerType}/deactivate', [CustomersController::class, 'deactivate']);
///////
Route::get('menu/{roleId}', [ModuleController::class, 'getMenuByRole']);

/////////////////////////
Route::post('/sales', [SalesContoller::class, 'createInvoice']);