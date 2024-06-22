<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $evaluations = Evaluation::all();
        return response()->json($evaluations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $evaluation = Evaluation::find($id);
        return response()->json($evaluation);
    }

    public function workerEvaluations($id)
    {
        $evaluations = Evaluation::where('worker_id', $id)->get();

        $formattedEvaluations = $evaluations->map(function ($evaluation) {
            $evaluation->worker_name = $evaluation->worker->name;
            unset($evaluation['worker']);
            $evaluation->date = Carbon::parse($evaluation->date)->format('d/m/Y');
            return $evaluation;
        });

        return response()->json($formattedEvaluations);
    }
}
