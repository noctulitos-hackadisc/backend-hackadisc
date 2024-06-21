<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Status::create([
            'id' => 1,
            'type' => 'Evaluado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Status::create([
            'id' => 2,
            'type' => 'En intervención',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Status::create([
            'id' => 3,
            'type' => 'Intervenido',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
