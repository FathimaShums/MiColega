<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RegisterController; 


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::get('/skills', [TeachController::class, 'showSkills'])->name('skills.show');

// Default route for the welcome page
Route::get('/', function () {
    return view('welcome');
});
// Registration Routes
//Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'store']); // Add this for the POST request
Route::get('/register', [RegisterController::class, 'create'])->name('register');

// Group routes that require authentication
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        // Update the /teach route to use the TeachController
        Route::get('/teach', [TeachController::class, 'index'])->name('teach');
    });

// Group admin-specific routes
Route::middleware(['auth', RedirectIfNotAdmin::class]) // Removed 'web' middleware since it's implied
    ->prefix('admin') // Optional: Using prefix to clearly separate admin routes
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
