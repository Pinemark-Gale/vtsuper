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
            'title' => 'Uncatigorized',
            'description' => 'Default when a user has no privilege. Gives no acces to website features.'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Student',
            'description' => 'Someone who is able to view resources and pages. Can make submissions but cannot make activities.'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Teacher',
            'description' => 'Someone who is able to make activities and approve the students in their class. Can also add resources.'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Contributor',
            'description' => 'Someone who is able to create resources and view pages and activities.'
        ]);

        \App\Models\Privilege::create([
            'title' => 'Admin',
            'description' => 'Someone who has complete and unfettered access to the whole website.'
        ]);
    }
}
