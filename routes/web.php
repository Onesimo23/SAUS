<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Chat;
use App\Http\Controllers\Google2FAController;
use App\Livewire\UserComponent;
use App\Livewire\Logs;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\ProjectController;


Route::redirect('/', 'login');

Route::get('/auth/github', [GithubController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [GithubController::class, 'handleGithubCallback'])->name('auth.github.callback');
Route::resource('projects', ProjectController::class);

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

// Verificação de permissões via policy para cada ação
Route::get('/projects/{project}', [ProjectController::class, 'show'])->middleware('can:view,project')->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->middleware('can:update,project')->name('projects.edit');
Route::get('/projects/{project}/manage', [ProjectController::class, 'manage'])->middleware('can:manage,project')->name('projects.manage');
Route::post('/projects/{project}/add-user', [ProjectController::class, 'addUser'])->middleware('can:manage,project')->name('projects.addUser');

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
