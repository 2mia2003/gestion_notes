<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Module;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FiliereController extends Controller
{
    /**
     * Display filieres list and selected details.
     */
    public function index(Request $request, ?Filiere $filiere = null)
    {
        // All filieres for left list
        $filieres = Filiere::query()
            ->with(['departement'])
            ->withCount('niveaux')
            ->orderBy('nom')
            ->get(['id', 'departement_id', 'code', 'nom']);

        $creating = $request->boolean('create');

        // Pick selected filiere: route-model or first, unless creating
        $selected = $creating ? null : ($filiere ?: ($filieres->first() ?: null));

        if ($selected) {
            // Load related details for right panel
            $selected->load([
                'departement',
                'niveaux.modules.responsable',
                'niveaux.modules.semestre',
            ]);
        }

        // Flatten modules across niveaux for convenience
        $modules = collect();
        if ($selected) {
            foreach ($selected->niveaux as $niv) {
                foreach ($niv->modules as $mod) {
                    $modules->push($mod);
                }
            }
        }

        $departements = Departement::orderBy('nom')->get(['id','nom']);

        return view('filiere&module_dessine.filieres-index', [
            'filieres' => $filieres,
            'selected' => $selected,
            'modules' => $modules,
            'departements' => $departements,
            'creating' => $creating,
            'tab' => 'filieres',
        ]);
    }

    /** Store a new filiere */
    public function store(Request $request)
    {
        $data = $request->validate([
            'departement_id' => ['required','exists:departements,id'],
            'code' => [
                'required','string','max:20',
                Rule::unique('filieres')->where(fn($q)=>$q->where('departement_id',$request->input('departement_id'))),
            ],
            'nom' => ['required','string','max:150'],
        ]);

        $filiere = Filiere::create($data);

        return redirect()->route('filiere.index', ['filiere' => $filiere->id])
            ->with('status','Filière créée avec succès');
    }

    /** Update an existing filiere */
    public function update(Request $request, Filiere $filiere)
    {
        $data = $request->validate([
            'departement_id' => ['required','exists:departements,id'],
            'code' => [
                'required','string','max:20',
                Rule::unique('filieres')->where(fn($q)=>$q->where('departement_id',$request->input('departement_id')))->ignore($filiere->id),
            ],
            'nom' => ['required','string','max:150'],
        ]);

        $filiere->update($data);

        return redirect()->route('filiere.index', ['filiere' => $filiere->id])
            ->with('status','Filière mise à jour');
    }

    /** Delete a filiere */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('filiere.index')->with('status','Filière supprimée');
    }
}
