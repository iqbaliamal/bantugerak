<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('admin', function () {
    return view('admin.pages.home');
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
    });
});
