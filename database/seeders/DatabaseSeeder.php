<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Declare variables. */
        $MAX_SCHOOLS = 3;
        $MAX_PRIVILEGES = 4;
        $USERS_PER_SCHOOL = (24 / ($MAX_SCHOOLS * $MAX_PRIVILEGES));
     
        /* Clear static database items before seeding users. */
        \App\Models\Privilege::truncate();
        \App\Models\School::truncate();

        /* Add expected privileges for app. */
        $this->call([PrivilegeSeeder::class]);
        
        /* Generate x users for x privileges in x schools. */
        for ($s = 0; $s < $MAX_SCHOOLS; $s++) {
            $school = \App\Models\School::factory()->create();
            for ($p = 0; $p < $MAX_PRIVILEGES; $p++) {
                \App\Models\User::factory($USERS_PER_SCHOOL)->state([
                    'privilege_id' => $p + 1,
                ])->for($school)->create();
            }    
        }

    }
}
