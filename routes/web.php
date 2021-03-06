<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KasirController;

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
    return view('Login.login');
});

// Route Admin
route::get('/login',[LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
Route::get('/user', [UserController::class ,'index'])->name('users');
Route::get('/user/tambah', [UserController::class ,'tambah'])->name('users');
Route::post('/user/store', [UserController::class ,'store'])->name('users');
Route::post('/user/update', [UserController::class ,'update'])->name('users');
Route::get('/user/edit/{id} ',[UserController::class ,'edit'])->name('users');
Route::get('/user/delete/{id} ',[UserController::class ,'delete'])->name('users');

// Route Manager
Route::resource('Manajer', ManagerController::class);
Route::get('laporan',[ManagerController::class, 'laporan'])->name('laporan');
Route::get('search',[ManagerController::class, 'search'])->name('search');
Route::get('laporan/pdf',[ManagerController::class, 'cetak'])->name('cetak');

// Route Kasir
Route::resource('Kasir', KasirController::class);





Route::group(['middleware' => ['auth','ceklevel:admin,manajer,kasir']], function () {
    route::get('/home',[HomeController::class,'index'])->name('home');

});
