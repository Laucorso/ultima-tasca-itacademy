<?php

namespace Database\Factories;

use App\Models\User;
use Database\Factories\UserFactory;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->userName,
        ];
    }
}
