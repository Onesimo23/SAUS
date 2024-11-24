<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Chat;
use App\Http\Controllers\Google2FAController;
use App\Livewire\UserComponent;
use App\Livewire\Logs;

Route::redirect('/', 'login');

// Rotas que precisam apenas de autenticação básica
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rotas de configuração do 2FA
    Route::get('/2fa', [Google2FAController::class, 'index'])->name('2fa.index');
    Route::post('/2fa', [Google2FAController::class, 'store'])->name('2fa.store');
    Route::get('/2fa/verify', [Google2FAController::class, 'verify'])->name('2fa.verify');
    Route::post('/2fa/verify', [Google2FAController::class, 'validateCode'])->name('2fa.validate');

    Route::get('/chat', Chat::class);

    // Rotas que não precisam de 2FA
    Route::get('/logs', Logs::class)->name('logs');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Rotas que precisam de 2FA
Route::middleware(['auth:sanctum', 'verified', '2fa'])->group(function () {
    // Rotas que precisam de 2FA

    Route::get('/usuarios', UserComponent::class)->name('usuarios');
});
