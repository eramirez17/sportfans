<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SeasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Season::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $caption = $this->faker->unique->sentence(3);
        return [            
            'caption' => $caption,
            'slug' => Str::slug($caption,'-'),
            'competition_id' => rand(1,10),
            'quota' => $this->faker->randomElement([20,30,32,64]),
            'start_date' => $this->faker->date('Y-m-d'),
            'end_date' => $this->faker->date('Y-m-d'),
            'status' => $this->faker->randomElement(['SET','STARTED','BREAK','ENDED']),
        ];
    }
}
