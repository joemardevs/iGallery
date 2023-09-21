<?php

use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        return redirect()->route('home');
    }
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
    Route::post('/sign-in', 'signIn')
        ->name('sign-in');

    //Submit a data to register
    Route::post('/register', 'store')
        ->name('register');

    //Logout
    Route::get('/signout', 'signOut')
        ->name('logout');
});


Route::middleware('auth')->group(function () {

    //If authenticated view artwork/s
    Route::controller(ArtworkController::class)->group(function () {
        Route::get('/home', 'index')
            ->name('home');
        Route::get('/artwork/{artwork}', 'show')
            ->name('show.artwork');
    });

    // Filter
    Route::get('/filter', [FilterController::class, 'index'])->name('filter');

    //Edit profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::patch('/profile/update-profile/{user}', 'update')
            ->name('profile.update');
        Route::patch('profile/update-password/{user}', 'updatePassword')
            ->name('profile.updatePassword');
    });

    // Show artworks by category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/{category}', 'index')
            ->name('show.artworks.by.category');
    });
});
