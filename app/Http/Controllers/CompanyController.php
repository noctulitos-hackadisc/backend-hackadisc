<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        $user = auth()->user();
        if ($user->role_id == 3) {
            $area_chief = $user->areaChief;
            $area = $area_chief->area;

            $workers = Worker::where([['company_id', $area->company_id], ['area_id', $area->id]])->get();
            $workers->load('area', 'post', 'status', 'evaluations');
        } else if ($user->role_id == 2) {
            $manager = $user->manager;
            $company = $manager->companies;

            $workers = $company->flatMap(function ($company) {
                return $company->workers->load('area', 'post', 'status', 'evaluations');
            });
        } else {
            $workers = Worker::all();
            $workers->load('area', 'post', 'status', 'evaluations');
        }

        $formattedWorkers = $workers->map(function ($worker) {
            $worker->evaluations = $worker->evaluations->map(function ($evaluation) {
                $evaluation->date = Carbon::parse($evaluation->date)->format('d/m/Y');
                return $evaluation;
            });
            return $worker;
        });
        return response()->json($formattedWorkers);
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
        $user = auth()->user();

        if ($user->role_id == 3) {
            $area_chief = $user->areaChief;
            $area = $area_chief->area;
            $workers = Worker::where([['company_id', $area->company_id], ['area_id', $area->id]])->get();
            $workers->load('area', 'post', 'status', 'evaluations');
        } else {
            $workers = $company->workers->load('area', 'post', 'status', 'evaluations');
        }
        $formattedWorkers = $workers->map(function ($worker) use ($company) {
            $worker->company_name = $company->name;
            $worker->evaluations = $worker->evaluations->map(function ($evaluation) {
                $evaluation->date = Carbon::parse($evaluation->date)->format('d/m/Y');
                return $evaluation;
            });
            return $worker;
        });
        return response()->json($formattedWorkers);
    }
}
