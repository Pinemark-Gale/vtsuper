<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PronounSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Make common sources for app. */
        \App\Models\Pronoun::create([
            'pronouns' => 'not specified'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'he/him'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'she/her'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'they/them'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'they/he'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'they/she'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'he/they'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'she/they'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'she/her/hers'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'he/him/his'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'they/them/theirs'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'he/she/theirs'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'xe/xir'
        ]);

        \App\Models\Pronoun::create([
            'pronouns' => 'xe/xir/xeir'
        ]);

    }
}
