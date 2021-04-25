<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Option::class, 20)->create()->each(function(App\Option $option){
        	$option->profiles->sync([
        		rand(1,2),
        		rand(2,3),
        		rand(4,5),
        	])
        }
    }
}
