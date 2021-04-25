<?php

namespace Database\Factories;

use App\Models\Stadium;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StadiumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stadium::class;

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
            'abstract' => $this->faker->text(100),
            'capacity' => rand(10000,30000),
            'picture' => $this->faker->imageUrl($width=400, $height=400),
        ];
    }
}
