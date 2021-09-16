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
            'type' => 'Article'
        ]);

        \App\Models\ResourceType::create([
            'type' => 'Video'
        ]);

        \App\Models\ResourceType::create([
            'type' => 'Game'
        ]);
    }
}
