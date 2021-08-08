<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "Manage Users",
            "Manage Rôles",
            "Manage Commandes",
            "Manage Boissons",
            "Manage Fournisseurs",
            "Manage Clients",
            "Manage Catégories Boissons"

        ];

        foreach ($permissions as $value) {
            Permission::create(["name"=>$value]);
        }
    }
}
