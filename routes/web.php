<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilesController;
use App\Mail\NewUserWelcomeMail;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PostController::class, 'index']);

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});

Route::post('follow/{user}', [FollowsController::class, 'store']);

Route::get('/p/create', [PostController::class, 'create']);
Route::post('/p', [\App\Http\Controllers\PostController::class, 'store']);
Route::get('/p/{post}', [PostController::class, 'show']);


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
// Route::get('home', [App\Http\Controllers\ProfilesController::class, 'index'])->name('home');
