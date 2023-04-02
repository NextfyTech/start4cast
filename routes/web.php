<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as AdminController;
use App\Http\Controllers\Admin\CategorylistController;
use App\Http\Controllers\Admin\ViewController;


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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/category', [App\Http\Controllers\Admin\CategoryController::class, 'data_index'])->name('category.data_index');

/*------------------------------------Add Data----------------------------------------------------------*/
 //Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.add');


 /*-----------------------------------category List-----------------------------------------*/
Route::get('/categorylist', [App\Http\Controllers\Admin\CategorylistController::class, 'index'])->name('category.list');
Route::get('/adddata', [CategorylistController::class,'store'])->name('addData');
Route::get('/viewdata', [CategorylistController::class,'view'])->name('viewData');
Route::any('/edit/{id}', [CategorylistController::class,'edit'])->name('edit');
    Route::any('/update/{id}', [CategorylistController::class,'update'])->name('update');
Route::get('/delete/{id}', [CategorylistController::class,'delete']);
Route::get('/search', [ViewController::class,'search'])->name('search');

/*------------------------------------ViewData----------------------------------------------------------*/

Route::get('/viewdata', [App\Http\Controllers\Admin\ViewController::class, 'index'])->name('category.view');


Route::any('/daily', [App\Http\Controllers\Admin\dailyController::class, 'index'])->name('Data_Manager.daily');
Route::any('/weekly', [App\Http\Controllers\Admin\weeklyController::class, 'index'])->name('Data_Manager.weekly');
Route::any('/monthly', [App\Http\Controllers\Admin\monthlyController::class, 'index'])->name('Data_Manager.monthly');
Route::any('/yearly', [App\Http\Controllers\Admin\yearlyController::class, 'index'])->name('Data_Manager.yearly');
Route::get('/view', [App\Http\Controllers\Admin\viewDataController::class, 'index'])->name('Data_Manager.view');
Route::get('/searchSpecialData', [App\Http\Controllers\Admin\viewDataController::class, 'search'])->name('searchSpecialData');

Route::get('/getweeks',[ViewController::class,'getWeeks'])->name('getWeeks');
Route::get('/getweeksinweek',[ViewController::class,'getweeksinweek'])->name('getweeksinweek');

Route::get('/star_sign_master', [App\Http\Controllers\Admin\StarSignMasterController::class, 'index'])->name('star_sign_master.index');






