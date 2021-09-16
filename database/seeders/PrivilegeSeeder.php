<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common privileges for app. */
        \App\Models\Privilege::create([
            'title' => 'Student'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Teacher'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Contributor',
        ]);

        \App\Models\Privilege::create([
            'title' => 'Admin'
        ]);
    }
}
