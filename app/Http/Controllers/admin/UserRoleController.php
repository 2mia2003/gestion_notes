<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        $roles = Role::orderBy('name')->pluck('name'); // ['admin','etudiant',...]

        return view('admin.dashboard', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        // Empêche de se retirer admin à soi-même (sécurité basique)
        if (auth()->id() === $user->id && $user->hasRole('admin') && $request->role !== 'admin') {
            return back()->with('error', "Tu ne peux pas retirer ton propre rôle admin.");
        }

        $user->syncRoles([$request->role]);

        return back()->with('success', "Rôle mis à jour pour {$user->name} : {$request->role}");
    }

    public function updateDetails(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', "Profil mis à jour pour {$user->name}.");
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', "Tu ne peux pas supprimer ton propre compte.");
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "Utilisateur supprimé: {$name}.");
    }
}
