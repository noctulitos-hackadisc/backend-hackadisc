<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\AreaChief;
use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $manager = Role::where('name', 'Gerente')->first();
        $administrator = Role::where('name', 'Administrador')->first();
        $areaChief = Role::where('name', 'Jefe de area')->first();

        User::create([
            'id' => 1,
            'email' => 'administrador@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $administrator->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 2,
            'email' => 'manager_main@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $manager->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 3,
            'email' => 'manager_unique@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $manager->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 4,
            'email' => 'manager_sub@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $manager->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 5,
            'email' => 'area_chief_1@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $areaChief->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'id' => 6,
            'email' => 'area_chief_2@pignus.cl',
            'password' => bcrypt('password'),
            'role_id' => $areaChief->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Administrator::create([
            'id' => 1,
            'name' => 'Administrador de Pignus',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1,
        ]);

        Manager::create([
            'id' => 1,
            'name' => 'Gerente Main',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 2,
        ]);

        Manager::create([
            'id' => 2,
            'name' => 'Gerente Unique',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 3,
        ]);

        Manager::create([
            'id' => 3,
            'name' => 'Gerente Sub',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 4,
        ]);

        AreaChief::create([
            'id' => 1,
            'name' => 'Jefe de area 1',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 5,
        ]);

        AreaChief::create([
            'id' => 2,
            'name' => 'Jefe de area 2',
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 6,
        ]);
    }
}
