<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\StudentRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Inscription publique autorisée uniquement pour le tout premier utilisateur (gérée dans le contrôleur)
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Self-registration for students (public)
    Route::get('etudiant/register', [StudentRegisterController::class, 'create'])->name('student.register');
    Route::post('etudiant/register', [StudentRegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Création de comptes réservée aux admins (après bootstrap)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);

        // Admin-driven student registration (with profile details)
        Route::get('admin/etudiants/register', [StudentRegisterController::class, 'create'])->name('admin.student.register');
        Route::post('admin/etudiants/register', [StudentRegisterController::class, 'store']);
    });
});