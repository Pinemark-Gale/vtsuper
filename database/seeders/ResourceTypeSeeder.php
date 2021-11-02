<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common resource types for app. */
        \App\Models\ResourceType::create([
            'type' => 'Uncatigorized'
        ]);

        \App\Models\ResourceType::create([
            'type' => 'Student'
        ]);

        \App\Models\ResourceType::create([
            'type' => 'Educator'
        ]);
    }
}
