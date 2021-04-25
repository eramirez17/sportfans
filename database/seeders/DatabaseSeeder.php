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
        //seguridad
    	\App\Models\Module::factory(20)->create();
        \App\Models\Permission::factory(30)->create();
    	\App\Models\Profile::factory(20)->create();
        \App\Models\Option::factory(20)->create();
        \App\Models\User::factory(30)->create();

        //sportfans
        \App\Models\Stadium::factory(20)->create();
        \App\Models\Region::factory(20)->create();
        \App\Models\Sport::factory(20)->create();
        \App\Models\Team::factory(20)->create();
        \App\Models\Competition::factory(20)->create();
        \App\Models\Season::factory(20)->create();
        // \App\Models\User::factory(10)->create();
    }
}
