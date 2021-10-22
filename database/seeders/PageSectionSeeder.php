<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make default section for app. */
        \App\Models\PageSection::create([
            'section' => 'Footer'
        ]);

        \App\Models\PageSection::create([
            'section' => 'Main Navigation'
        ]);
    }
}
