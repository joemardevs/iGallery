<?php

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

// To view the sign in
Route::get('/sign-in', function () {
    return view('livewire.auth.sign-in');
})->name('sign-in');

// To view the register
Route::get('/register', function () {
    return view('livewire.auth.register');
})->name('register');

// To view the forgot-password
Route::get('/forgot-password', function () {
    return view('livewire.auth.forgot-password');
})->name('forgot-password');
