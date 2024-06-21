<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $company = Company::find($id);

        if (auth()->user()->role_id == 3) {
            $area_chief = auth()->user()->areaChief;
            $area = $area_chief->area;
            $workers = Worker::where([['company_id', $area->company_id], ['area_id', $area->id]])->get();
            $workers->load('area', 'post', 'status');
        } else {
            $workers = $company->workers->load('area', 'post', 'status');
        }
        return response()->json($workers);
    }
}
