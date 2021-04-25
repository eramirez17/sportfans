<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,3),
            'module_id' => rand(1,5),
            'list' => $this->faker->randomElement(['0','1']),
            'check' => $this->faker->randomElement(['0','1']),
            'create' => $this->faker->randomElement(['0','1']),
            'edit' => $this->faker->randomElement(['0','1']),
            'delete' => $this->faker->randomElement(['0','1']),
        ];
    }
}
