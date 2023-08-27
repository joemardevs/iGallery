<?php

use App\Http\Controllers\Auth\AuthController;
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
    return view('livewire.auth.sign-in');
});

Route::middleware('guest')->group(function () {
    // To view the sign in
    Route::get('/sign-in', function () {
        return view('livewire.auth.sign-in');
    });

    // To view the register
    Route::get('/register', function () {
        return view('livewire.auth.register');
    });

    // To view the forgot-password
    Route::get('/forgot-password', function () {
        return view('livewire.auth.forgot-password');
    })->name('forgot-password');
});


// Auth Controller
Route::controller(AuthController::class)->group(function () {
    //Submit a data to sign in
    Route::post('/sign-in', 'signIn')->name('sign-in');

    //Submit a data to register
    Route::post('/register', 'store')->name('register');

    //Logout
    Route::get('/signout', 'signOut')->name('logout');
});


Route::middleware('auth')->group(function () {

    //View the home if authenticated
    Route::get('/home', function () {
        return view('livewire.pages.index');
    })->name('home');
});
