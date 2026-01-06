<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProfessorDashboardController extends Controller
{
    /**
     * Page d'accueil du professeur avec statistiques
     */
    public function welcome(): View
    {
        $user = auth()->user();
        
        // Les modules dont ce professeur est responsable
        $modules = Module::where('responsable_user_id', $user->id)
            ->with(['niveau', 'semestre'])
            ->orderBy('code')
            ->get();

        // Préparer les statistiques pour chaque module
        $moduleStats = [];
        
        foreach ($modules as $module) {
            // Étudiants du niveau
            $totalStudents = Etudiant::where('niveau_id', $module->niveau_id)->count();
            
            // Étudiants avec des notes dans ce module
            $studentsWithNotes = Note::whereHas('document.module', function($q) use ($module) {
                $q->where('id', $module->id);
            })->distinct('etudiant_id')->count('etudiant_id');

            // Étudiants sans notes
            $studentsWithoutNotes = $totalStudents - $studentsWithNotes;

            $moduleStats[] = [
                'id' => $module->id,
                'code' => $module->code,
                'nom' => $module->nom,
                'niveau' => $module->niveau->nom,
                'totalStudents' => $totalStudents,
                'studentsWithNotes' => $studentsWithNotes,
                'studentsWithoutNotes' => $studentsWithoutNotes,
            ];
        }

        return view('professor.welcome', [
            'user' => $user,
            'moduleStats' => $moduleStats,
        ]);
    }

    /**
     * Tableau de bord avec la liste des étudiants
     */
    public function dashboard(): View
    {
        $user = auth()->user();
        
        // Les modules dont ce professeur est responsable
        $modules = Module::where('responsable_user_id', $user->id)
            ->with(['niveau', 'semestre'])
            ->orderBy('code')
            ->get();

        // Préparer les données des étudiants pour tous les modules
        $etudiants = [];
        
        foreach ($modules as $module) {
            $students = Etudiant::where('niveau_id', $module->niveau_id)
                ->with(['notes' => function($q) use ($module) {
                    $q->where('module_id', $module->id);
                }])
                ->orderBy('nom')
                ->get();

            foreach ($students as $student) {
                $etudiants[] = [
                    'id' => $student->id,
                    'matricule' => $student->matricule,
                    'nom' => $student->nom,
                    'prenom' => $student->prenom,
                    'module' => $module->code . ' - ' . $module->nom,
                    'notes' => $student->notes->map(function($note) {
                        return [
                            'type' => $note->type,
                            'valeur' => $note->valeur,
                        ];
                    })->toArray(),
                ];
            }
        }

        return view('professor.dashboard', [
            'user' => $user,
            'etudiants' => $etudiants,
        ]);
    }
}
