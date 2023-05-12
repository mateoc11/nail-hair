<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\SupportsController;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\AdminController;
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
    return redirect('/posts');
});

Route::get('/test', function () {
    return view('welcomes');
});

Route::get('/test2', function () {
    return view('about');
});


Route::get('/profile',[App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'update_avatar'])->name('profile');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/anuncios', [App\Http\Controllers\PostsController::class, 'index2'])->name('anuncios');
Route::resource('posts', PostsController::class);
Route::resource('profiles', UserController::class);
Route::get('citas/create/{cita}',[App\Http\Controllers\CitasController::class, 'create'])->name('citas.create');
Route::get('citas/{cita}/confirm',[App\Http\Controllers\CitasController::class, 'confirm'])->name('citas.confirm');
Route::get('citas/{cita}/cancel',[App\Http\Controllers\CitasController::class, 'cancel'])->name('citas.cancel');
Route::get('citas/{cita}/usercancel',[App\Http\Controllers\CitasController::class, 'usercancel'])->name('citas.usercancel');
Route::resource('citas', CitasController::class)->except([
    'create','edit'
]);
Route::get('/citas2', [App\Http\Controllers\CitasController::class, 'index2'])->name('citas2');
Route::post('/rate',[App\Http\Controllers\RatingsController::class, 'store'])->name('rate');
Route::put('/admin/ban/{user}',[App\Http\Controllers\AdminController::class, 'ban'])->name('admin.ban');
Route::put('/admin/banad/{ad}',[App\Http\Controllers\AdminController::class, 'banad'])->name('admin.banad');
Route::resource('likes', LikesController::class)->only([
    'store'
]);
Route::resource('supports', SupportsController::class);
Route::get('/pendiente', [App\Http\Controllers\HomeController::class, 'validatepending'])->name('pendiente');
Route::resource('validate', ValidateController::class)->except([
    'create',
]);
Route::get('/admin/stats', [App\Http\Controllers\AdminController::class, 'stats'])->name('stats');
Route::post('/admin/stats',[App\Http\Controllers\AdminController::class, 'stats'])->name('stats');
Route::get('/admin/roles',[App\Http\Controllers\AdminController::class, 'rolesindex'])->name('rolesindex');
Route::get('/admin/revision', [App\Http\Controllers\AdminController::class, 'revision'])->name('revision');
Route::get('/admin/user/{user}', [App\Http\Controllers\AdminController::class, 'showuser'])->name('showuser');
Route::post('/admin/role/update',[App\Http\Controllers\AdminController::class, 'roleupdate'])->name('roleupdate');