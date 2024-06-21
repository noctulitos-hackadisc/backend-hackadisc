<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AreaChiefController extends Controller
{
    public function profile()
    {
        $user = auth()->user()->load('areaChief');
        $areaChief = $user->areaChief;
        $areaChief->load('area');

        $response = [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'role' => $user->role,
                'profile' => [
                    'id' => $areaChief->id,
                    'name' => $areaChief->name,
                    'created_at' => $areaChief->created_at,
                    'updated_at' => $areaChief->updated_at,
                    'companies' => $areaChief->area->company
                ],
            ],
        ];

        return response()->json($response);
    }
}
