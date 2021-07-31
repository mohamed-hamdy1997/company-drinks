<?php

use App\Mail\SendAccountDataForNewUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Testing\Fluent\Concerns\Has;

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

Route::post('add-user', [\App\Http\Controllers\UserController::class]);

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'usersPage'])->name('usersPage');

    Route::get('/add-user', function () {
        return view('add-user');
    })->name('addUserPage');

    Route::get('/drinks', function () {
        return view('drinks');
    })->name('drinksPage');

    Route::post('/add-user', [\App\Http\Controllers\UserController::class, 'addUser'])->name('addUser');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'updateUserPage'])->name('updateUserPage');
    Route::post('/update-user', [\App\Http\Controllers\UserController::class, 'updateUser'])->name('updateUser');

});

