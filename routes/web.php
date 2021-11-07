<?php

use App\Http\Controllers\Admin\Roles\roleController;
use App\Http\Controllers\Admin\Visualize\visualizeController;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth'], function (){
    Route::get('/', function () {
        return redirect()->route('admin.home');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\Admin\homeController::class, 'index'])->name('admin.home');

Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'],function(){
    Route::get('/admin/users', [userController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}', [userController::class, 'view'])->name('admin.view');
    Route::get('/admin/users/delete/{id}', [userController::class, 'delete'])->name('admin.users.delete');
    Route::get('/admin/user/create', [userController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/users/save', [userController::class, 'save'])->name('admin.users.save');
    Route::get('/admin/users/edit/{id}', [userController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users/edit/save', [userController::class, 'update'])->name('admin.users.edit.save');
    Route::get('/admin/user/profile', [userController::class, 'profile'])->name('admin.users.profile');

    Route::get('/admin/roles', [roleController::class, 'index'])->name('admin.roles');
    Route::get('/admin/role/create', [roleController::class, 'create'])->name('admin.role.create');
    Route::post('/admin/roles/save', [roleController::class, 'save'])->name('admin.roles.save');
    Route::get('/admin/roles/edit/{id}', [roleController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/admin/roles/edit/save', [roleController::class, 'update'])->name('admin.roles.edit.save');
    Route::get('/admin/roles/delete/{id}', [roleController::class, 'delete'])->name('admin.roles.delete');
    Route::get('/admin/roles/{id}', [roleController::class, 'view'])->name('admin.role.view');


    Route::get('/admin/game', [visualizeController::class, 'visualize'])->name('game');
    Route::get('/admin/visualize', [visualizeController::class, 'index'])->name('visualize');
});
