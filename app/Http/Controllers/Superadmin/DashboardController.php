<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $totalUser = User::where('role_id', 3)->count();
        $totalSuperadmin = User::where('role_id', 1)->count();
        $totalAdmin = User::where('role_id', 2)->count();
        $totalSAdmin = $totalSuperadmin + $totalAdmin;
        return view('superadmin.dashboard', [
            'totalUser' => $totalUser,
            'totalAdmin' => $totalSAdmin
        ]);
    }
}
