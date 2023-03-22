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

Route::any('/category', [App\Http\Controllers\Admin\CategoryController::class, 'data_index'])->name('category.data_index');

Route::get('/star_sign_master', [App\Http\Controllers\Admin\StarSignMasterController::class, 'index'])->name('star_sign_master.index');






