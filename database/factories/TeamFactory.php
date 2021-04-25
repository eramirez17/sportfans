<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

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
            'stadium_id' => rand(1,5),
            'sport_id' => rand(1,5),
            'region_id' => rand(1,5),
            'logo' => $this->faker->imageUrl($width=400, $height=400),
            'slug' => Str::slug($caption,'-'),
            'type' => $this->faker->randomElement(['club','nation']),
        ];
    }
}
