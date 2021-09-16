<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common sources for app. */
        \App\Models\Source::create([
            'source' => 'Substance Abuse and Mental Health Services Administration'
        ]);

        \App\Models\Source::create([
            'source' => 'NCBI'
        ]);

        \App\Models\Source::create([
            'source' => 'Addiction Center'
        ]);
    }
}
