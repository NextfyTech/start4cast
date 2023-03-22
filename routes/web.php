<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as AdminController;


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
/*------------------------------------Add Data----------------------------------------------------------*/
Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.add');
/*-----------------------------------category List-----------------------------------------*/
Route::get('/categorylist', [App\Http\Controllers\Admin\Categorylist::class, 'index'])->name('category.list');
Route::get('adddata', [Categorylist::class,'store'])->name('addData');
Route::post('add', 'Categorylist@add');

/*------------------------------------ViewData----------------------------------------------------------*/

Route::get('/viewdata', [App\Http\Controllers\Admin\ViewController::class, 'index'])->name('category.view');

Route::get('/star_sign_master', [App\Http\Controllers\Admin\StarSignMasterController::class, 'index'])->name('star_sign_master.index');






