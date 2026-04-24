<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\MidtransWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Subscription checkout MUST require auth
    Route::post('/subscribe/checkout', [SubscriptionController::class, 'checkout'])->name('subscribe.checkout');
});

// Subscription marketing page
Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe');
Route::get('/subscribe/login', function () {
    session(['url.intended' => route('subscribe')]);
    return redirect()->route('login');
})->name('subscribe.login');

// Recipe detail
Route::get('/recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');

// Webhook for midtrans
Route::post('/api/midtrans-callback', [MidtransWebhookController::class, 'handle']);

require __DIR__.'/auth.php';
