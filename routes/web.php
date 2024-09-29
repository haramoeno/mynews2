<?php

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

Route::get('/', function () {
    return view('welcome');
});

// コメントとして、機能の内容を記述してみましょう
// ユーザが admin/news/create にアクセスしたときに
// コントローラ NewsController の add アクションに受け渡す
use App\Http\Controllers\Admin\NewsController;
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
});


use App\Http\Controllers\Admin\AAAController;
Route::controller(AAAController::class)->prefix('XXX')->group(function() {
    Route::get('XXX', 'bbb');
});


use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->group(function() {
    Route::get('profile/create', 'add')->middleware('auth');
    Route::get('profile/edit', 'edit')->middleware('auth');;
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
