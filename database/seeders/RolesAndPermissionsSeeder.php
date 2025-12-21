<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'scan_import_notes',
            'user_manage',
            'archive_edit',
            'security_logs_view',
            'global_force_logout',
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions($permissions);

        $enseignant = Role::firstOrCreate(['name' => 'Enseignant']);
        $enseignant->syncPermissions(['scan_import_notes', 'archive_edit']);

        $secretaire = Role::firstOrCreate(['name' => 'Secretaire']);
        $secretaire->syncPermissions(['scan_import_notes']);

        // Met Admin sur le user id=1 si existe
        if ($user = User::find(1)) {
            $user->syncRoles(['Admin']);
        }
    }
}
