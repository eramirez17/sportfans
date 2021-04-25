<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Option::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $caption = $this->faker->unique->word(10);
        return [
            'caption' => $caption,
            'link' => Str::slug($caption,'-'),
            'abstract' => $this->faker->text(100),
            'parent_id' => null,
            'target' => $this->faker->randomElement(['_blank','_self','_parent','_top']),//dandom
            'level' => $this->faker->randomElement(['root','node']),//dandom
            'module_id' => rand(1,5),//dandom
        ];
    }
}
