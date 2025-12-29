<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use Illuminate\Http\Request;

class AnneeAcademiqueController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'libelle' => ['required','string','max:150','unique:annees_academiques,libelle'],
            'active' => ['sometimes','boolean'],
        ]);
        $annee = null;
        \DB::transaction(function () use ($data, &$annee) {
            $makeActive = (bool)($data['active'] ?? false);
            if ($makeActive) {
                AnneeAcademique::query()->update(['active' => false]);
            }
            $annee = AnneeAcademique::create([
                'libelle' => $data['libelle'],
                'active' => $makeActive,
            ]);
        });

        return redirect()->route('semestre.index', ['create' => 1])
            ->with('status', 'Année académique ajoutée')
            ->with('new_annee_id', optional($annee)->id);
    }

    public function setActive(Request $request, AnneeAcademique $annee)
    {
        // Ensure only one active year
        \DB::transaction(function () use ($annee) {
            AnneeAcademique::query()->update(['active' => false]);
            $annee->forceFill(['active' => true])->save();
        });

        return redirect()->route('semestre.index', ['create' => 1])
            ->with('status', 'Année académique active définie: ' . $annee->libelle);
    }
}
