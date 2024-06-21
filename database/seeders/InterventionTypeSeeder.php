<?php

namespace Database\Seeders;

use App\Models\InterventionType;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InterventionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = storage_path('app/public/datasets_seeders/interventions.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            InterventionType::create([
                'name' => $data['type'],
                'intervened_competencies' => $data['intervened_competency'],
                'duration' => $data['duration_days'],
                'description' => $data['details'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
