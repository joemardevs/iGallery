<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Artwork;
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

Route::get('/create-symlink', function () {
    symlink(storage_path('/app/public'), public_path('storage'));
    echo "Symlink Created. Thanks";
});
<<<<<<< HEAD
=======

>>>>>>> 1b29ad7d7ea490807450ac6558fbebe79959c8ec
Route::get('/', function () {
    return redirect()->route('home');
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



//If authenticated view artwork/s
Route::controller(ArtworkController::class)->group(function () {
    Route::get('/home', 'index')
        ->name('home');
    Route::get('/artwork/{artwork}', 'show')
        ->name('show.artwork');
});


// Filter
Route::get('/filter', [FilterController::class, 'index'])
    ->name('filter');

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

Route::controller(FilterController::class)->group(function () {
    Route::get('/filter/artworks', 'show')
        ->name('filter.artworks');
});

Route::controller(ArtistController::class)->group(function () {
    Route::get('/artist/{artist}', 'index')
        ->name('artist.profile');
});

//Auth middlware
Route::middleware('auth')->group(function () {

    //payment
    Route::get('/artwork/{artwork}/payment-confirmation', [PaymentController::class, 'pay'])
        ->name('payment.confirmation');
    Route::get('/artwork/payment/success', [PaymentController::class, 'success'])
        ->name('payment.success');

    //Artist middleware
    Route::middleware('is.artist')->group(function () {
        Route::get('upload-artwork', [ArtistController::class, 'uploadArtworkIndex'])
            ->name('upload.artwork.index');
        Route::post('upload-artwork', [ArtistController::class, 'uploadArtwork'])
            ->name('upload.artwork');

        Route::get('/artwork/delete/{artwork}', [ArtworkController::class, 'destroy'])
            ->name('delete.artwork');

        //Edit artwork
        Route::get('/artwork/edit/{artwork}', [ArtworkController::class, 'edit'])
            ->name('edit.artwork');
        Route::post('/artwork/update/{artwork}', [ArtworkController::class, 'update'])
            ->name('update.artwork');
    });
});
