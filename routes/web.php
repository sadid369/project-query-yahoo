<?php

use App\Http\Controllers\UserController;
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
    return view('welcome');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/users', "showUsers")->name('home');
    Route::get('/user/{id}', "singleUser")->name('view.user');
    Route::post('/add', 'addUser')->name('adduser');
    Route::put('/update/{id}', 'updateUser')->name('update');
    Route::get('/delete/{id}', 'deleteUser')->name('delete');
    Route::get('updateview/{id}', 'updateView')->name('updateuser');
});
Route::view('/newuser','adduser', )->name('newuser');
