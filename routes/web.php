<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\TeachController;

// Default route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

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
