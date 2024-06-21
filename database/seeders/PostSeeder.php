<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/posts.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            Post::create([
                'id' => $data['id'],
                'name' => $data['name'],
                'created_at' => now(),
                'updated_at' => now(),
                'company_id' => $data['company_id'],
            ]);
        }
    }
}
