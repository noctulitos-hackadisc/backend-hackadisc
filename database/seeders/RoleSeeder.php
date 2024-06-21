<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'id' => 1,
            'name' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Role::create([
            'id' => 2,
            'name' => 'Gerente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Role::create([
            'id' => 3,
            'name' => 'Jefe de area',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
