<?php

namespace Database\Seeders;

use App\Models\PageStatus;
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
        /* Clear static database items before seeding users. */
        // \App\Models\User::truncate();
        // \App\Models\Privilege::truncate();
        // \App\Models\School::truncate();

        /* Add expected privileges, resource types, and
         * resource tags for app. 
         * */
        $this->call([PrivilegeSeeder::class]);
        $this->call([ResourceTagSeeder::class]);
        $this->call([ResourceTypeSeeder::class]);
        $this->call([SourceSeeder::class]);
        $this->call([SchoolSeeder::class]);
        $this->call([PageSectionSeeder::class]);
        $this->call([PageStatusSeeder::class]);
        $this->call([UserSeeder::class]);
        
        /* Generate schools and store for user attachment. */
        $schools = \App\Models\School::factory(5)->create();

        /* Make users for each school. */
        foreach ($schools as $school) {
                \App\Models\User::factory(5)->for($school)->create();
        }

        /* Generate pages. */
        \App\Models\Page::factory(10)->create();

        /* Link pages to sections. */
        $pages = \App\Models\Page::all();
        $sections = \App\Models\PageSection::all();

        foreach ($pages as $page) {
            $rand_sections = $sections->random(2);
            $page->sections()->attach($rand_sections[0]);
            $page->sections()->attach($rand_sections[1]);
        }

        /* Generate resources. */
        \App\Models\Resource::factory(5)->create();

        /* Link resources to tags. */
        $resources = \App\Models\Resource::all();
        $tags = \App\Models\ResourceTag::all();

        foreach ($resources as $resource) {
            $rand_tags = $tags->random(2);
            $resource->tags()->attach($rand_tags[0]);
            $resource->tags()->attach($rand_tags[1]);
        }

    }
}
