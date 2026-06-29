<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/session-add', function () {
        return view('modules.sessions.add');
    });
    
    //shed1
    Route::Resource('/shed1', App\Http\Controllers\Shed1LController::class);
    Route::get('/shed1-report',[ App\Http\Controllers\Shed1LController::class,'report']);
    //shed2
    Route::Resource('/shed2', App\Http\Controllers\Shed2RController::class);
    Route::get('/shed2-report',[ App\Http\Controllers\Shed2RController::class,'report']);
    
    
    //feed
    Route::Resource('/feed-inventory', App\Http\Controllers\FeedInventoryController::class);
    
    
    //med inventory
    Route::Resource('/medicine-inventory', App\Http\Controllers\MedicineInventoryController::class);
    
    //diesel
    Route::Resource('/users', App\Http\Controllers\UserController::class);
    Route::Resource('/diesel', App\Http\Controllers\DieselController::class);
    
    //wood
    Route::Resource('/wood', App\Http\Controllers\WoodController::class);
    
    //medicine
    Route::Resource('/medicine', App\Http\Controllers\MedicineController::class);
    
    //assets
    Route::Resource('/asset', App\Http\Controllers\AssetsController::class);
    Route::Resource('/sale', App\Http\Controllers\SaleController::class);
    Route::Resource('/category', App\Http\Controllers\SaleCategoryController::class);
    
    //std 1
    Route::Resource('/std1', App\Http\Controllers\StdHouse1Controller::class);
    
    //std2
    Route::Resource('/std2', App\Http\Controllers\StdHouse2Controller::class);
    Route::get('/all-sales/{id}/{type}',[App\Http\Controllers\SaleController::class,'allSales']);
    Route::get('/print/{id}/{type}',[App\Http\Controllers\SaleController::class,'print']);
    //session
    Route::Resource('/session', App\Http\Controllers\FarmSessionController::class);
    //flock
    Route::Resource('/flock-standard', App\Http\Controllers\FlockStandardController::class);
    Route::Resource('/std-house1', App\Http\Controllers\StdHouse1Controller::class);
    Route::Resource('/std-house2', App\Http\Controllers\StdHouse2Controller::class);
    //farm
    Route::Resource('/farm', App\Http\Controllers\ProtienFarmController::class);
    Route::Resource('/management', App\Http\Controllers\ManagementController::class);
    Route::Resource('/management2', App\Http\Controllers\Management2Controller::class);
    Route::get('logout', [App\Http\Controllers\Controller::class, 'logout']);

});
