<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Administrator;

class AdministratorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $administrator = Administrator::all();
        return response()->json($administrator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $administrator = Administrator::find($id);
        return response()->json($administrator);
    }


    /**
     * Display the profile of the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = auth()->user()->load('administrator');
        $administrator = $user->administrator;
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
                'id' => $user->id,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => $user->role,
                'profile' => [
                    'id' => $administrator->id,
                    'name' => $administrator->name,
                    'created_at' => $administrator->created_at,
                    'updated_at' => $administrator->updated_at,
                    'companies' => $companies,
                ],
            ],
        ];

        // Return the user auth and the companies
        return response()->json($response);
    }
}
