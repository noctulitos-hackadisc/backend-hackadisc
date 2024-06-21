<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/type_interventions.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            $evaluation = Evaluation::where('id', $data['evaluation_id'])->first();

            Evaluation::create([
                'adaptability_to_change' => $data['adaptability_to_change'],
                'safe_conduct' => $data['safe_conduct'],
                'dynamism_energy' => $data['dynamism_energy'],
                'personal_effectiveness' => $data['personal_effectiveness'],
                'initiative' => $data['initiative'],
                'working_under_pressure' => $data['working_under_pressure'],
                'date' => $evaluation,
                'created_at' => now(),
                'updated_at' => now(),
                'evaluation_id' => $evaluation->id ?? null,
            ]);
        }
    }
}
