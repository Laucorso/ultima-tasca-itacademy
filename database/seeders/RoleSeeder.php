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
        $admin = Role::create(['guard_name' => 'api', 'name' => 'admin']);
        $jugador = Role::create(['guard_name' => 'api', 'name' => 'jugador']);
        Permission::create(['guard_name' => 'api','name' => 'vistaAdmin'])->assignRole($admin);
        Permission::create(['guard_name' => 'api', 'name' => 'rankingtotal'])->assignRole($admin);
        Permission::create(['guard_name' => 'api', 'name' => 'rankingLoser'])->assignRole($admin);
        Permission::create(['guard_name' => 'api', 'name' => 'rankingWinner'])->assignRole($admin);

        Permission::create(['guard_name' => 'api', 'name' => 'vistaJugador'])->assignRole($jugador);
        Permission::create(['guard_name' => 'api', 'name' => 'edit.nickname'])->assignRole($jugador);
        Permission::create(['guard_name' => 'api', 'name' => 'jugadors.show'])->assignRole($jugador);
    }
}
