<?php

namespace App\Http\Controllers;

use App\Models\InterventionType;

class InterventionTypeController extends Controller
{

    public function index()
    {
        // Obtiene todos los registros de la tabla types intervention
        $interventions = InterventionType::all();
        return response()->json($interventions);
    }
}
