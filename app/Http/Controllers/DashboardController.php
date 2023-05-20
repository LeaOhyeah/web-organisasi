<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\News;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        $data = [
            'usersActive' => User::where('is_active', true)->get(),
            'newsMonthly' => News::whereYear('created_at', '=', date('Y'))
                ->whereMonth('created_at', '=', date('m'))
                ->get(),
            'eventsYear' => News::whereYear('created_at', '=', date('Y'))
                ->get(),
            'usersUnverified' => User::where('is_verified', false)->get(),
        ];

        // dd($data);
        return view('dashboard.index_admin', $data);
    }
}
