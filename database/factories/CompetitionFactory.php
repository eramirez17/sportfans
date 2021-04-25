<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompetitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Competition::class;

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
            'abstract' => $this->faker->text(100),
            'logo' => $this->faker->imageUrl($width=400, $height=400),
            'slug' => Str::slug($caption,'-'),
            'sport_id' => rand(1,10),
            'region_id' => rand(1,5),
            'type' => $this->faker->randomElement(['club','nation']),
        ];
    }
}
