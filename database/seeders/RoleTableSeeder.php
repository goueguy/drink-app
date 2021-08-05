<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "Admin",
            "Gérant"
        ];
        foreach ($roles as $role) {
            # code...
            Role::create([
                "name"=>$role
            ]);
        }
    }
}
