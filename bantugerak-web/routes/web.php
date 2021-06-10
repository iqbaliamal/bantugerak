<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KegiatanController;

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
    return view('user.pages.home');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
// Replace Default Routes Login
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('admin/login',  [LoginController::class, 'login'])->name('admin.login');

// ROUTE ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //Dashboard
    Route::get('/', 'DashboardController@index');

    // Auth Admin
    Route::middleware(['admin'])->group(function () {

        // Kegiatan
        Route::get('kegiatan', [KegiatanController::class, 'index'])->name('list.kegiatan');
        Route::get('kegiatan/tambah', [KegiatanController::class, 'create'])->name('tambah.kegiatan');
        Route::get('kegiatan/edit/{id}', [KegiatanController::class, 'edit'])->name('edit.kegiatan');
        Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('add.kegiatan');
        Route::post('kegiatan/update/{id}', 'KegiatanController@update')->name('update.kegiatan');
        Route::get('/kegiatan/delete/{id}', 'KegiatanController@destroy')->name('delete.kegiatan');
    });
});
