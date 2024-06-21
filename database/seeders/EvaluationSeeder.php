<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Evaluation;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/evaluations.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            $date = Carbon::parse($data['date'])->toDateTime();
            $worker = Worker::where('id', $data['user_id'])->first();

            if ($worker) {
                Evaluation::create([
                    'adaptability_to_change' => $data['adaptability_to_change'],
                    'safe_conduct' => $data['safe_conduct'],
                    'dynamism_energy' => $data['dynamism_energy'],
                    'personal_effectiveness' => $data['personal_effectiveness'],
                    'initiative' => $data['initiative'],
                    'working_under_pressure' => $data['working_under_pressure'],
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'worker_id' => $worker->id,
                ]);
            }
        }
    }
}
