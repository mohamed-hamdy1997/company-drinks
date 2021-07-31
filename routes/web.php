<?php

use App\Http\Controllers\UserController;
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
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');



    Route::get('/users', [\App\Http\Controllers\UserController::class, 'usersPage'])->name('usersPage');
    Route::get('/add-user', function () {
        return view('add-user');
    })->name('addUserPage');
    Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');
    Route::get('/user/{id}', [UserController::class, 'updateUserPage'])->name('updateUserPage');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');


//    drinks
    Route::get('/drinks', [UserController::class, 'getDrinks'])->name('drinksPage');
    Route::get('/add-drink', [UserController::class, 'addDrinkPage'])->name('addDrinkPage');
    Route::post('/add-drink', [UserController::class, 'addDrink'])->name('addDrink');

    Route::post('/update-drink', [UserController::class, 'updateDrink'])->name('updateDrink');
    Route::get('/delete-drink/{id}', [UserController::class, 'deleteDrink'])->name('deleteDrink');
    Route::post('/order-drink', [UserController::class, 'orderDrink'])->name('orderDrink');

});

