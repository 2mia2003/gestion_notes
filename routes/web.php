 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\AnneeAcademiqueController;
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

    // Gestion Filières (accessible à tout utilisateur authentifié)
    Route::get('/filiere/{filiere?}', [FiliereController::class, 'index'])
        ->name('filiere.index');
    Route::post('/filiere', [FiliereController::class, 'store'])->name('filiere.store');
    Route::put('/filiere/{filiere}', [FiliereController::class, 'update'])->name('filiere.update');
    Route::delete('/filiere/{filiere}', [FiliereController::class, 'destroy'])->name('filiere.destroy');

    // Départements (création rapide)
    Route::post('/departement', [DepartementController::class, 'store'])->name('departement.store');

    // Modules
    Route::get('/module/{module?}', [ModuleController::class, 'index'])->name('module.index');
    Route::post('/module', [ModuleController::class, 'store'])->name('module.store');
    Route::put('/module/{module}', [ModuleController::class, 'update'])->name('module.update');
    Route::delete('/module/{module}', [ModuleController::class, 'destroy'])->name('module.destroy');

    // Semestres
    Route::get('/semestre/{semestre?}', [SemestreController::class, 'index'])->name('semestre.index');
    Route::post('/semestre', [SemestreController::class, 'store'])->name('semestre.store');
    Route::put('/semestre/{semestre}', [SemestreController::class, 'update'])->name('semestre.update');
    Route::delete('/semestre/{semestre}', [SemestreController::class, 'destroy'])->name('semestre.destroy');

    // Année académique (création rapide depuis la page Semestres)
    Route::post('/annee-academique', [AnneeAcademiqueController::class, 'store'])->name('annee-academique.store');
    Route::post('/annee-academique/{annee}/set-active', [AnneeAcademiqueController::class, 'setActive'])->name('annee-academique.set-active');
                                       
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
    // Removed duplicate view route that shadowed filiere.index controller route
    Route::get('/imports/upload', fn() => view('imports.step1_upload'))->name('imports.step1');
Route::get('/imports/details', fn() => view('imports.step2_details'))->name('imports.step2');
Route::get('/imports/validation', fn() => view('imports.step3_validation'))->name('imports.step3');

});

require __DIR__.'/auth.php';
