<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('accueil')
        : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('accueil');
    })->name('dashboard');

    Route::get('/accueil', function () {
        return view('accueil');
    })->name('accueil');

    Route::get('/parametres', function () {
        return view('parametres');
    })->name('parametres');

    // ✅ NOM CORRIGÉ ICI (point au lieu de underscore)
    Route::get('/gestion-profil', function () {
        return view('gestion_profil');
    })->name('gestion.profil');
});

require __DIR__.'/auth.php';
