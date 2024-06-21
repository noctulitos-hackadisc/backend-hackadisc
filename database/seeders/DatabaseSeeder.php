<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InterventionTypeSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            CompanyTypeSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            PostSeeder::class,
            AreaSeeder::class,
            WorkerSeeder::class,
            EvaluationSeeder::class,
            // InterventionSeeder::class,
        ]);
    }
}
