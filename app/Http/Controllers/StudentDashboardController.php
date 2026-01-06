<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentDashboardController extends Controller
{
    /**
     * Affiche le dashboard de l'étudiant avec ses notes
     */
    public function index(): View
    {
        $user = auth()->user();
        
        // Récupérer toutes les notes disponibles
        // Note: Dans une application réelle, on lierait Student à User
        $notes = Note::with(['document.module', 'etudiant'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.dashboard', [
            'notes' => $notes,
            'user' => $user,
        ]);
    }

    /**
     * Formulaire pour changer le mot de passe
     */
    public function editPassword(): View
    {
        return view('student.edit-password');
    }

    /**
     * Mettre à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                function($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Le mot de passe actuel est incorrect.');
                    }
                },
            ],
            'password' => ['required', 'confirmed', 'min:8', 'different:current_password'],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
