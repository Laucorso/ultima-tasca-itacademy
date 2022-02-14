<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $jugador = Role::create(['name' => 'jugador']);
        Permission::create(['name' => 'vistaAdmin'])->assignRole($admin);
        Permission::create(['name' => 'rankingtotal'])->assignRole($admin);
        Permission::create(['name' => 'rankingLoser'])->assignRole($admin);
        Permission::create(['name' => 'rankingWinner'])->assignRole($admin);
        Permission::create(['name' => 'vistaJugador'])->assignRole($jugador);
        Permission::create(['name' => 'edit.nickname'])->assignRole($jugador);
        Permission::create(['name' => 'update.nickname'])->assignRole($jugador);


    }
}
