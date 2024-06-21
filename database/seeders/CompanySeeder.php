<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyType;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/public/datasets_seeders/companies.xlsx');
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();
        $header = array_shift($rows);
        $unique_company = CompanyType::where('name', 'Unique')->first();
        $main_company = CompanyType::where('name', 'Main')->first();
        $subcompany = CompanyType::where('name', 'Subcompany')->first();

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            Company::create([
                'id' => $data['id'],
                'name' => $data['name'],
            ]);
        }

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // Determine company type and parent company
            $companyTypeId = $subcompany->id;
            $parentCompanyId = $data['company_manager_id'];

            // Check if company_manager_id exists and find its type
            if (empty($data['company_manager_id'])) {
                $companyId = (int) $data['id'];
                $parentCompanyId = null;
                $found = false;

                // Search for companyId in the dataset
                foreach ($rows as $rowToCheck) {
                    $iterator = array_combine($header, $rowToCheck);
                    if ($iterator['company_manager_id'] == $companyId) {
                        // If found, determine if it's a main company
                        $companyTypeId = $main_company->id;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    // If not found, determine if it's a unique company
                    $companyTypeId = $unique_company->id;
                }
            }

            // Update company record with determined company type and parent company
            $company = Company::find($data['id']);

            $company->update([
                'manager_id' => $data['manager_id'] ?? null,
                'company_type_id' => $companyTypeId,
                'parent_company_id' => $parentCompanyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
