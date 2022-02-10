<?php

namespace Database\Factories;

use App\Models\Jugador;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $min = 1;
        $max = 6;
        return [
            'dau1' =>$this->faker->numberBetween($min, $max),
            'dau2' =>$this->faker->numberBetween($min, $max),
            'resultat' =>$this->faker->boolean(),
            'jugador_id' => Jugador::all()->random()->id 
        ];
    }
}
