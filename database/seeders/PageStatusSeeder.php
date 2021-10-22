<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make default statuses for app. */
        \App\Models\PageStatus::create([
            'status' => 'Draft'
        ]);

        \App\Models\PageStatus::create([
            'status' => 'Published'
        ]);
    }
}
