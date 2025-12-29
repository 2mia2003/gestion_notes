<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Niveau;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    public function index(Request $request, ?Module $module = null)
    {
        $columns = ['id','niveau_id','semestre_id','code','nom','responsable_user_id','credits'];
        if (Schema::hasColumn('modules', 'statut')) {
            $columns[] = 'statut';
        }

        $modules = Module::query()
            ->with(['niveau.filiere', 'semestre', 'responsable'])
            ->orderBy('code')
            ->get($columns);

        $creating = $request->boolean('create');
        $selected = $creating ? null : ($module ?: ($modules->first() ?: null));

        $niveaux = Niveau::orderBy('code')->get(['id','code','nom','filiere_id']);
        $semestres = Semestre::query()
            ->whereHas('anneeAcademique', function ($q) {
                $q->where('active', true);
            })
            ->orderBy('code')
            ->get(['id','code','nom']);
        // Only users with professor role(s); avoid exception if roles are missing
        $users = User::query()
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['enseignant']);
            })
            ->orderBy('name')
            ->get(['id','name']);

        return view('filiere&module_dessine.modules-index', [
            'modules' => $modules,
            'selected' => $selected,
            'niveaux' => $niveaux,
            'semestres' => $semestres,
            'users' => $users,
            'creating' => $creating,
            'tab' => 'modules',
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'niveau_id' => ['required','exists:niveaux,id'],
            'semestre_id' => ['required','exists:semestres,id'],
            'code' => ['required','string','max:20', Rule::unique('modules','code')],
            'nom' => ['required','string','max:150'],
            'responsable_user_id' => ['nullable','exists:users,id'],
            'credits' => ['nullable','integer','min:0','max:30'],
        ];
        if (Schema::hasColumn('modules', 'statut')) {
            $rules['statut'] = ['required','string', Rule::in(['en_attente','actif','inactif'])];
        } else {
            $rules['statut'] = ['nullable','string', Rule::in(['en_attente','actif','inactif'])];
        }

        $data = $request->validate($rules);
        if (!Schema::hasColumn('modules', 'statut')) {
            unset($data['statut']);
        }

        // Ensure responsable is professor if provided
        if (!empty($data['responsable_user_id'])) {
            $u = User::find($data['responsable_user_id']);
            if (!$u || !$u->hasAnyRole(['enseignant'])) {
                return back()->withErrors(['responsable_user_id' => 'Le responsable doit être un professeur (enseignant).'])->withInput();
            }
        }

        $module = Module::create($data);
        return redirect()->route('module.index', ['module' => $module->id])->with('status', 'Module créé');
    }

    public function update(Request $request, Module $module)
    {
        $rules = [
            'niveau_id' => ['required','exists:niveaux,id'],
            'semestre_id' => ['required','exists:semestres,id'],
            'code' => ['required','string','max:20', Rule::unique('modules','code')->ignore($module->id)],
            'nom' => ['required','string','max:150'],
            'responsable_user_id' => ['nullable','exists:users,id'],
            'credits' => ['nullable','integer','min:0','max:30'],
        ];
        if (Schema::hasColumn('modules', 'statut')) {
            $rules['statut'] = ['required','string', Rule::in(['en_attente','actif','inactif'])];
        } else {
            $rules['statut'] = ['nullable','string', Rule::in(['en_attente','actif','inactif'])];
        }

        $data = $request->validate($rules);
        if (!Schema::hasColumn('modules', 'statut')) {
            unset($data['statut']);
        }

        // Ensure responsable is professor if provided
        if (!empty($data['responsable_user_id'])) {
            $u = User::find($data['responsable_user_id']);
            if (!$u || !$u->hasAnyRole(['enseignant'])) {
                return back()->withErrors(['responsable_user_id' => 'Le responsable doit être un professeur (enseignant).'])->withInput();
            }
        }

        $module->update($data);
        return redirect()->route('module.index', ['module' => $module->id])->with('status', 'Module mis à jour');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('module.index')->with('status','Module supprimé');
    }
}
