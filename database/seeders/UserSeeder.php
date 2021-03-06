<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => "admin",
            'email' => "admin@example.com",
            'password' => Hash::make("admin"),
            'school_id' => 1,
            'privilege_id' => 5,
            'pronoun_id' => 1
        ]);
    }
}
