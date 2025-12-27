<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Crée rôles & permissions puis attribue 'admin' au user #1
        $this->call(RolesAndPermissionsSeeder::class);

        // Données minimales pour s'inscrire en tant qu'étudiant
        // (Département, Filière, Niveaux)
        $this->seedAcademicDefaults();
    }

    private function seedAcademicDefaults(): void
    {
        // Avoid importing models at top to keep file minimal
        $departementModel = \App\Models\Departement::class;
        $filiereModel = \App\Models\Filiere::class;
        $niveauModel = \App\Models\Niveau::class;

        if ($departementModel::count() === 0) {
            $dep = $departementModel::create([
                'code' => 'INF',
                'nom' => 'Informatique',
            ]);

            $fil = $filiereModel::create([
                'departement_id' => $dep->id,
                'code' => 'GL',
                'nom' => 'Génie Logiciel',
            ]);

            foreach (['L1' => 'Licence 1', 'L2' => 'Licence 2', 'L3' => 'Licence 3'] as $code => $nom) {
                $niveauModel::create([
                    'filiere_id' => $fil->id,
                    'code' => $code,
                    'nom' => $nom,
                ]);
            }
        }
    }
}
