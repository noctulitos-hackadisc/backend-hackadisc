<?php

namespace App\Http\Controllers;

use App\Models\Company;

class AdministratorController extends Controller
{

    public function profile()
    {
        // Get all companies with their managers
        $companies = Company::where('company_type_id', 1)
            ->orWhere('company_type_id', 2)
            ->get();
        $companies->load('manager');

        // Get all subcompanies with their managers
        $companies->each(function ($company) {
            if ($company->company_type_id == 2) {
                $company->subcompanies = Company::where('parent_company_id', $company->id)->get();
                $company->subcompanies->load('manager');
            }
        });

        $response = [
            'user' => [
                'id' => auth()->user()->id,
                'email' => auth()->user()->email,
                'created_at' => auth()->user()->created_at,
                'updated_at' => auth()->user()->updated_at,
                'role' => auth()->user()->role,
                'profile' => [
                    'id' => auth()->user()->administrator->id,
                    'name' => auth()->user()->administrator->name,
                    'created_at' => auth()->user()->administrator->created_at,
                    'updated_at' => auth()->user()->administrator->updated_at,
                    'companies' => $companies,
                ],
            ],
        ];

        // Return the user auth and the companies
        return response()->json($response);
    }
}
