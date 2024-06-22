<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $interventions = Intervention::all();
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
        $intervention = Intervention::find($id);
        return response()->json($intervention);
    }

    public function workerInterventions($id)
    {
        $interventions = Intervention::where('worker_id', $id)->get();
        return response()->json($interventions);
    }


    public function open(string $id, Request $request)
    {
        try {
            $worker = Worker::find($id);
            if (!$worker) {
                return response()->json(['error' => 'Worker not found'], 404);
            }

            if ($worker->status_id != 2) {
                $worker->status_id = 2;
                $worker->save();
            }

            Intervention::create([
                'start_date' => date('Y-m-d', strtotime('now')),
                'worker_id' => $worker->id,
                'intervened_competency' => $request->intervened_competency,
                'intervention_type_id' => $request->intervention_type_id,
                'evaluation_id' => $request->evaluation_id,
            ]);

            return response()->json(['message' => 'Intervention opened successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function close(string $id)
    {
        try {

            $intervention = Intervention::find($id);

            if (!$intervention) {
                return response()->json(['error' => 'Intervention not found'], 404);
            } else if ($intervention->active == false) {
                return response()->json(['error' => 'Intervention already closed'], 404);
            }

            $worker = $intervention->worker;
            if (!$worker) {
                return response()->json(['error' => 'Worker not found'], 404);
            }

            $intervention->active = false;
            $intervention->save();

            $worker_interventions = $worker->interventions;

            $active_intervention = $worker_interventions->filter(function ($intervention) {
                return $intervention->active == true;
            })->first();

            if (!$active_intervention) {
                $worker->status_id = 3;
                $worker->save();
            }

            // $intervention->end_date = date('Y-m-d', strtotime('now'));
            // $intervention->save();

            return response()->json(['message' => 'Intervention closed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'unexpected error'], 404);
        }
    }
}
