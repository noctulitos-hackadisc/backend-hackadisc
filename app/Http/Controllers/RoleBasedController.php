<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RoleBasedController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            return app(AdministratorController::class)->profile();
        } elseif ($user->role_id == 2) {
            return app(ManagerController::class)->profile();
        } elseif ($user->role_id == 3) {
            return app(AreaChiefController::class)->profile();
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
