<?php

namespace Database\Factories;

use App\Models\Power;
use Illuminate\Database\Eloquent\Factories\Factory;

class PowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Power::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->paragraph(),
        ];
    }
}
