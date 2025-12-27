 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;

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
    });
    Route::view('/filieres', 'filiere.index')->name('filiere.index');
});

require __DIR__.'/auth.php';
