<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partida;
use App\Models\User;
use App\Models\Jugador;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);        
        
        User::factory(10)->create()->each(function($user){
            Jugador::factory()->create([
                'user_id'=>$user->id
            ]);
            $user->assignRole('jugador');
        });
        Partida::factory(250)->create();
    }
}
