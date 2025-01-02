<?php

use App\Http\Controllers\UserController;
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
    return view('users.index');
});

Route::get('/users', [UserController::class, 'index']);

Route::get('users/data', [UserController::class, 'getUsersData'])->name('users.data');

Route::get('/api/search', [UserController::class, 'autocomplete'])->name('autocomplete');
Route::get('/api/data', [UserController::class, 'getData'])->name('data');