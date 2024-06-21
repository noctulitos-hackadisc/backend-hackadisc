<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/areas.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            Area::create([
                'id' => $data['area_id'],
                'name' => $data['area_name'],
                'created_at' => now(),
                'updated_at' => now(),
                'company_id' => $data['company_id'],
                'area_chief_id' => $data['area_chief_id'] ?? null,
            ]);
        }
    }
}
