<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);
        $user_power = get_user_power($user->current_school_code, $user->id);
        session(['user_power' => $user_power]);
        return redirect()->route('index');
    }

    public function impersonate_leave($action = null)
    {
        Auth::user()->leaveImpersonation();
        $user_power = get_user_power(Auth::user()->current_school_code, Auth::user()->id);
        session(['user_power' => $user_power]);
        return redirect()->route('index');
    }
}
