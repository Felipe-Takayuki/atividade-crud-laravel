<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('tasks.show')
        : redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| Rotas de Visitantes (Convidados / Não Autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| Rotas Autenticadas (Protegidas pelo Middleware 'auth')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD 1: Gestão de Conta & Perfil do Usuário (Implementado 100%)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD 2: Gestão de Tarefas
    // Gera automaticamente as 7 rotas resource: tasks.index, tasks.create,
    // tasks.store, tasks.show, tasks.edit, tasks.update e tasks.destroy.
    Route::resource('tasks', TaskController::class);
});
