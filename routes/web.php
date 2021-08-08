<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DrinkController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\FournisseurController;
use App\Http\Controllers\Admin\CategoryDrinkController;

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
    Route::middleware('can:manage-users')->group(function () {
        Route::prefix('users')->group(function () {
        Route::get('/',[UserController::class,'index'])->name('users');
        Route::get('/create',[UserController::class,'create'])->name('users.create');
        Route::post('/store',[UserController::class,'store'])->name('users.store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::get('/profile',[UserController::class,'profile'])->name('users.profile');
        Route::get('/password/edit/{id}',[UserController::class,'editPassword'])->name('users.password.edit');
        Route::post('/password/update/{id}',[UserController::class,'updateUserPassword'])->name('users.password.update');
        Route::get('/password',[UserController::class,'showPassword'])->name('users.password');
        Route::post('/password/change',[UserController::class,'password'])->name('users.password.post');
        Route::post('/update/{id}',[UserController::class,'update'])->name('users.update');
        Route::get('/delete/{id}',[UserController::class,'destroy'])->name('users.delete');
        });
    });
    #------------------------RÔLES UTILISATEURS----------------------------
    Route::middleware('can:manage-roles')->group(function () {
        Route::prefix('roles')->group(function () {
        Route::get('/',[RoleController::class,'index'])->name('roles');
        Route::get('/create',[RoleController::class,'create'])->name('roles.create');
        Route::get('/permission/{role}',[RoleController::class,'permission'])->name('roles.permission');
        Route::post('/store',[RoleController::class,'store'])->name('roles.store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('roles.edit');
        Route::post('/update/{id}',[RoleController::class,'update'])->name('roles.update');
        Route::get('/delete/{id}',[RoleController::class,'destroy'])->name('roles.delete');
        });
    });

    #------------------------PERMISSIONS UTILISATEURS----------------------------
    Route::middleware('can:manage-users')->group(function () {
        Route::prefix('permissions')->group(function () {
        Route::get('/',[PermissionController::class,'index'])->name('permissions');
        Route::get('/create',[PermissionController::class,'create'])->name('permissions.create');
        Route::post('/store',[PermissionController::class,'store'])->name('permissions.store');
        Route::get('/edit/{id}',[PermissionController::class,'edit'])->name('permissions.edit');
        Route::post('/update/{id}',[PermissionController::class,'update'])->name('permissions.update');
        Route::get('/delete/{id}',[PermissionController::class,'destroy'])->name('permissions.delete');
        });
    });
    #------------------------FOURNISSEURS----------------------------
    Route::middleware('can:manage-fournisseurs')->group(function () {
        Route::prefix('fournisseurs')->group(function () {
        Route::get('/',[FournisseurController::class,'index'])->name('fournisseurs');
        Route::get('/create',[FournisseurController::class,'create'])->name('fournisseurs.create');
        Route::post('/store',[FournisseurController::class,'store'])->name('fournisseurs.store');
        Route::get('/edit/{id}',[FournisseurController::class,'edit'])->name('fournisseurs.edit');
        Route::post('/update/{id}',[FournisseurController::class,'update'])->name('fournisseurs.update');
        Route::get('/delete/{id}',[FournisseurController::class,'destroy'])->name('fournisseurs.delete');
        });
    });
    #------------------------BOISSONS---------------------------
    Route::middleware('can:manage-boissons')->group(function () {
            Route::prefix('drinks')->group(function () {
            Route::get('/',[DrinkController::class,'index'])->name('drinks');
            Route::get('/create',[DrinkController::class,'create'])->name('drinks.create');
            Route::post('/store',[DrinkController::class,'store'])->name('drinks.store');
            Route::get('/edit/{id}',[DrinkController::class,'edit'])->name('drinks.edit');
            Route::post('/update/{id}',[DrinkController::class,'update'])->name('drinks.update');
            Route::get('/delete/{id}',[DrinkController::class,'destroy'])->name('drinks.delete');
        });
    });
    #------------------------CATEGORIES DE BOISSONS---------------------------
    Route::middleware('can:manage-categories')->group(function () {
        Route::prefix('categories')->group(function () {
        Route::get('/',[CategoryDrinkController::class,'index'])->name('categories');
        Route::get('/create',[CategoryDrinkController::class,'create'])->name('categories.create');
        Route::post('/store',[CategoryDrinkController::class,'store'])->name('categories.store');
        Route::get('/edit/{id}',[CategoryDrinkController::class,'edit'])->name('categories.edit');
        Route::post('/update/{id}',[CategoryDrinkController::class,'update'])->name('categories.update');
        Route::get('/delete/{id}',[CategoryDrinkController::class,'destroy'])->name('categories.delete');
        });
    });
    #------------------------CLIENTS---------------------------
    Route::middleware('can:manage-clients')->group(function () {
        Route::prefix('clients')->group(function () {
        Route::get('/',[ClientController::class,'index'])->name('clients');
        Route::get('/create',[ClientController::class,'create'])->name('clients.create');
        Route::post('/store',[ClientController::class,'store'])->name('clients.store');
        Route::get('/edit/{id}',[ClientController::class,'edit'])->name('clients.edit');
        Route::post('/update/{id}',[ClientController::class,'update'])->name('clients.update');
        Route::get('/delete/{id}',[ClientController::class,'destroy'])->name('clients.delete');
        });
    });
    #------------------------COMMANDES DE BOISSONS---------------------------
    Route::middleware('can:manage-commandes')->group(function () {
        Route::prefix('commandes')->group(function () {
        Route::get('/',[CommandeController::class,'index'])->name('commandes');
        Route::get('/create',[CommandeController::class,'create'])->name('commandes.create');
        Route::post('/store',[CommandeController::class,'store'])->name('commandes.store');
        Route::get('/change/{id}',[CommandeController::class,'changeStatus'])->name('commandes.change-status');
        Route::get('/edit/{id}',[CommandeController::class,'edit'])->name('commandes.edit');
        Route::get('/show/{id}',[CommandeController::class,'show'])->name('commandes.show');
        Route::post('/update/{id}',[CommandeController::class,'update'])->name('commandes.update');
        Route::get('/delete/{id}',[CommandeController::class,'destroy'])->name('commandes.delete');
        });
    });

});
