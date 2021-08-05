<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', [AdminController::class,'index'])->name('accueil');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


#------------------------ESPACE ADMIN------------------------#
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['isAdmin']],function () {
    Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    #------------------------UTILISATEURS----------------------------
    Route::prefix('users')->group(function () {
        Route::get('/',[UserController::class,'index'])->name('users');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/store',[UserController::class,'store'])->name('users.store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::post('/update/{id}',[UserController::class,'update'])->name('users.update');
        Route::get('/delete/{id}',[UserController::class,'destroy'])->name('users.delete');
    });
});
