 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\SessionController;
// Removed academique controllers

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('accueil')
        : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // =========================
    // Routes accessibles à tous les connectés
    // =========================
    Route::get('/accueil', function () {
        return view('accueil');
    })->name('accueil');

    Route::get('/gestion-profil', function () {
        return view('gestion_profil');
    })->name('gestion.profil');

    // =========================
    // Zone ADMIN (Spatie)
    // =========================
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/parametres', function () {
            return view('parametres');
        })->name('parametres');

        // Dashboard admin (contient la gestion des users)
        Route::get('/admin', [UserRoleController::class, 'index'])
            ->name('admin.dashboard');

        // Mise à jour du rôle d’un utilisateur (FORMULAIRE)
        Route::put('/admin/users/{user}/role', [UserRoleController::class, 'updateRole'])
            ->name('admin.users.role.update');

        // Mise à jour des infos utilisateur (nom/email)
        Route::put('/admin/users/{user}', [UserRoleController::class, 'updateDetails'])
            ->name('admin.users.update');

        // Suppression d’un utilisateur
        Route::delete('/admin/users/{user}', [UserRoleController::class, 'destroy'])
            ->name('admin.users.destroy');

        // Déconnexion d’un utilisateur spécifique
        Route::post('/admin/sessions/users/{user}/logout', [SessionController::class, 'logoutUser'])
            ->name('admin.sessions.logout.user');

        // Déconnexion de tout le monde
        Route::post('/admin/sessions/logout-all', [SessionController::class, 'logoutAll'])
            ->name('admin.sessions.logout.all');

        // Academique routes removed per request
    });
    Route::view('/filieres', 'filiere.index')->name('filiere.index');
});

require __DIR__.'/auth.php';
