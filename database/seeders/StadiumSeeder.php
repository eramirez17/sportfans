<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Stadium::class, 30)->create();
    }
}
