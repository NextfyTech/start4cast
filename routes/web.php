<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as AdminController;
use App\Http\Controllers\Admin\CategorylistController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/category', [App\Http\Controllers\Admin\CategoryController::class, 'data_index'])->name('category.data_index');

/*------------------------------------Add Data----------------------------------------------------------*/
 //Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.add');
/*-----------------------------------category List-----------------------------------------*/
Route::get('/categorylist', [App\Http\Controllers\Admin\CategorylistController::class, 'index'])->name('category.list');
Route::get('adddata', [CategorylistController::class,'store'])->name('addData');
Route::post('add', 'Categorylist@add');

/*------------------------------------ViewData----------------------------------------------------------*/

Route::get('/viewdata', [App\Http\Controllers\Admin\ViewController::class, 'index'])->name('category.view');


Route::get('/daily', [App\Http\Controllers\Admin\dailyController::class, 'index'])->name('Data_Manager.daily');
Route::get('/weekly', [App\Http\Controllers\Admin\weeklyController::class, 'index'])->name('Data_Manager.weekly');
Route::get('/monthly', [App\Http\Controllers\Admin\monthlyController::class, 'index'])->name('Data_Manager.monthly');
Route::get('/yearly', [App\Http\Controllers\Admin\yearlyController::class, 'index'])->name('Data_Manager.yearly');
Route::get('/view', [App\Http\Controllers\Admin\viewDataController::class, 'index'])->name('Data_Manager.view');


Route::get('/star_sign_master', [App\Http\Controllers\Admin\StarSignMasterController::class, 'index'])->name('star_sign_master.index');






