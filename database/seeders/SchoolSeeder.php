<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common sources for app. */
        \App\Models\School::create([
            'name' => 'None',
            'district' => 'None'
        ]);
    }
}
