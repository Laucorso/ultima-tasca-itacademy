<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Laura',
            'last_name' => 'Cormand',
            'email' => 'lauc@gmail.com',
            'password' => bcrypt('Ggallag14!'),
            'remember_token' => Str::random(10),
        ])->assignRole('admin');
        
    }
}
