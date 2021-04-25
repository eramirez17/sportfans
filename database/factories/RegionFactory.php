<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RegionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Region::class;

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
            'picture' => $this->faker->imageUrl($width=400, $height=400),
            'slug' => Str::slug($caption,'-'),
            'parent_id' => NULL,            
            'external_link' => $this->faker->imageUrl($width=400, $height=400),            
        ];
    }
}
