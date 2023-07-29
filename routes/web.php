<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;

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

Route::get('/index', [StoreController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::view('/thank', 'thank')->name('thank');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', function () {
    return redirect('/login');
});
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::get('/index', [StoreController::class, 'index'])->name('index');
Route::get('/search', [StoreController::class, 'search'])->name('search');
Route::get('/favorites/add', [FavoriteController::class, 'addFavorite'])->name('favorites.add');
Route::post('/favorites/add', [FavoriteController::class, 'addFavorite'])->name('favorites.add');
Route::delete('/favorites/remove/{storeId}', [FavoriteController::class, 'removeFavorite']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/detail/{id}', [StoreController::class, 'show'])->name('store.detail');
Route::middleware('auth')->group(function () {
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});
Route::get('/done', function () {
    return 'Reservation successful!';
})->name('done');
Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
Route::delete('/reservations/delete', [ReservationController::class, 'delete'])->name('reservations.delete');
Route::put('/reservations/{id}', [UserController::class, 'update'])->name('reservation.update');
Route::get('/stores/{id}/evaluate', [StoreController::class, 'evaluate'])->name('store.evaluate');
Route::post('/stores/{id}/evaluate', [StoreController::class, 'storeEvaluation'])->name('store.evaluate.post');