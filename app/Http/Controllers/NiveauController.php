<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NiveauController extends Controller
{
    /**
     * Store a new niveau quickly (inline creation from module form)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'filiere_id' => ['required', 'exists:filieres,id'],
            'code' => ['required', 'string', 'max:20', Rule::unique('niveaux', 'code')],
            'nom' => ['required', 'string', 'max:150'],
        ]);

        $niveau = Niveau::create($data);

        // If coming from module form, refresh and return to module with new niveau selected
        return back()
            ->with('success', "Niveau '{$niveau->nom}' créé avec succès")
            ->with('niveau_id', $niveau->id);
    }
}
