<?php

namespace Database\Seeders;

use App\Models\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyType::create([
            'name' => 'Unique',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        CompanyType::create([
            'name' => 'Main',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        CompanyType::create([
            'name' => 'Subcompany',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
