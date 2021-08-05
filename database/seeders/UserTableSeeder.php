<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"Goueguy",
            "lastname"=>"Jean-Louis A.",
            "email"=>"admin@gmail.com",
            "password"=>Hash::make("1234567"),
            "role_id"=>1
        ]);
        User::create([
            "name"=>"laure",
            "lastname"=>"laure",
            "email"=>"laure@gmail.com",
            "password"=>Hash::make("1234567"),
            "role_id"=>1
        ]);
    }
}
