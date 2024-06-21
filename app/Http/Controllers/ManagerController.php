<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $manager = Manager::all();
        return response()->json($manager);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $manager = Manager::find($id);
        return response()->json($manager);
    }

    /**
     * Display the profile of the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = auth()->user()->load('manager');

        // Get all companies related to the manager
        $manager = $user->manager;
        $companies = $manager->companies;
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
                    'id' => $manager->id,
                    'name' => $manager->name,
                    'created_at' => $manager->created_at,
                    'updated_at' => $manager->updated_at,
                    'companies' => $companies
                ],
            ],
        ];

        return response()->json($response);
    }
}
