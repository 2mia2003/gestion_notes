<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Models\AnneeAcademique;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemestreController extends Controller
{
    public function index(Request $request, ?Semestre $semestre = null)
    {
        $semestres = Semestre::query()
            ->with(['anneeAcademique'])
            ->orderBy('code')
            ->get(['id','annee_academique_id','code','nom','date_debut','date_fin']);

        $creating = $request->boolean('create');
        $selected = $creating ? null : ($semestre ?: ($semestres->first() ?: null));

        $annees = AnneeAcademique::where('active', true)->orderBy('libelle')->get(['id','libelle']);
        $anneesAll = AnneeAcademique::orderBy('libelle')->get(['id','libelle','active']);

        return view('filiere&module_dessine.semestres-index', [
            'semestres' => $semestres,
            'selected' => $selected,
            'annees' => $annees,
            'anneesAll' => $anneesAll,
            'creating' => $creating,
            'tab' => 'semestres',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'annee_academique_id' => ['required','exists:annees_academiques,id'],
            'code' => [
                'required','string','max:20',
                Rule::unique('semestres','code')->where(function ($q) use ($request) {
                    return $q->where('annee_academique_id', $request->input('annee_academique_id'));
                })
            ],
            'nom' => ['required','string','max:150'],
            'date_debut' => ['required','date'],
            'date_fin' => ['required','date','after_or_equal:date_debut'],
        ]);

        $semestre = Semestre::create($data);
        return redirect()->route('semestre.index', ['semestre' => $semestre->id])->with('status', 'Semestre créé');
    }

    public function update(Request $request, Semestre $semestre)
    {
        $data = $request->validate([
            'annee_academique_id' => ['required','exists:annees_academiques,id'],
            'code' => [
                'required','string','max:20',
                Rule::unique('semestres','code')
                    ->ignore($semestre->id)
                    ->where(function ($q) use ($request) {
                        return $q->where('annee_academique_id', $request->input('annee_academique_id'));
                    })
            ],
            'nom' => ['required','string','max:150'],
            'date_debut' => ['required','date'],
            'date_fin' => ['required','date','after_or_equal:date_debut'],
        ]);

        $semestre->update($data);
        return redirect()->route('semestre.index', ['semestre' => $semestre->id])->with('status', 'Semestre mis à jour');
    }

    public function destroy(Semestre $semestre)
    {
        $semestre->delete();
        return redirect()->route('semestre.index')->with('status','Semestre supprimé');
    }
}
