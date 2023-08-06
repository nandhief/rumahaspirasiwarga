<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});
Route::get('login', [PageController::class, 'loginView'])->name('login');
Route::post('login', [PageController::class, 'login']);
Route::post('logout', [PageController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->prefix('sistem')->group(function () {
    Route::get('/', [SettingController::class, 'dashboard'])->name('dashboard');
    Route::resources([
        'settings' => SettingController::class,
        'posts' => PostController::class,
    ]);
});
