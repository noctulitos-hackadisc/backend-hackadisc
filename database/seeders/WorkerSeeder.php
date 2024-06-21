<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/workers.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            Worker::create([
                'id' => $data['user_id'],
                'name' => $data['name'],
                'created_at' => now(),
                'updated_at' => now(),
                'area_id' => $data['area_id'],
                'post_id' => $data['post_id'],
                'status_id' => $data['status_id'],
                'company_id' => $data['company_id'],
            ]);
        }
    }
}
