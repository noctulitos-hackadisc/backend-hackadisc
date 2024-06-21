<?php

namespace App\Http\Controllers;

use App\Models\InterventionType;

class InterventionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $interventions = InterventionType::all();
        return response()->json($interventions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $intervention = InterventionType::find($id);
        return response()->json($intervention);
    }
}
