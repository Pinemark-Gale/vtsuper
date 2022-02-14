<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivityAnswerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make default activity types. */
        \App\Models\ActivityAnswerType::create([
            'type' => 'fitb'
        ]);

        \App\Models\ActivityAnswerType::create([
            'type' => 'mc'
        ]);

        \App\Models\ActivityAnswerType::create([
            'type' => 'sa'
        ]);
    }
}
