<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourceTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common resource tags for app. */
        \App\Models\ResourceTag::create([
            'tag' => 'Substance Abuse & Prevention'
        ]);

        \App\Models\ResourceTag::create([
            'tag' => 'Mental Health'
        ]);

        \App\Models\ResourceTag::create([
            'tag' => 'Trigger Warning'
        ]);
    }
}
