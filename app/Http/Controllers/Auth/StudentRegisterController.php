<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class StudentRegisterController extends Controller
{
    /**
     * Show student registration form.
     */
    public function create(): View
    {
        // Minimal registration form (no academic selections)
        return view('auth.student-register');
    }

    /**
     * Handle student registration (creates User + Etudiant and assigns role).
     */
    public function store(RegisterStudentRequest $request): RedirectResponse
    {
        // Ensure roles exist
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'etudiant', 'guard_name' => 'web']);

        // Create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('admin');

        // For self-registration, redirect to login; for admin, back to dashboard
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Étudiant créé et compte utilisateur associé.');
        }

        return redirect()->route('login')
            ->with('success', 'Inscription réussie. Vous pouvez vous connecter.');
    }
}
