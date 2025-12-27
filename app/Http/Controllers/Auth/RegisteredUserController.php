<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $isFirstUser = User::count() === 0;
        if (! $isFirstUser) {
            if (! auth()->check() || ! auth()->user()->hasRole('admin')) {
                abort(403, 'Seul un admin peut créer des comptes.');
            }
        }

        $roles = Role::orderBy('name')->pluck('name');
        return view('auth.register', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $isFirstUser = User::count() === 0;
        if (! $isFirstUser) {
            if (! auth()->check() || ! auth()->user()->hasRole('admin')) {
                abort(403, 'Seul un admin peut créer des comptes.');
            }
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        // 2) créer user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3) créer les rôles si inexistants (noms en minuscule)
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'etudiant',  'guard_name' => 'web']);

        // Si c'est le tout premier user => admin forcé; sinon rôle choisi par l'admin
        $roleToAssign = $isFirstUser ? 'admin' : $request->role;
        $user->assignRole($roleToAssign);

        // 4) Connexion automatique seulement pour le tout premier utilisateur
        event(new Registered($user));
        if ($isFirstUser) {
            auth()->login($user);
            return redirect()->route('accueil')
                ->with('success', 'Premier utilisateur créé et connecté en tant qu\'admin.');
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Utilisateur créé ({$user->email}) avec le rôle: {$roleToAssign}");
    }
}
