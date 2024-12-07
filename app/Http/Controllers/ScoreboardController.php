<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ScoreboardController extends Controller
{
    public function index(){
        $leaderboard = DB::table('teams')
            ->select('teamname', 'score')
            ->orderByDesc('score') // Sắp xếp theo điểm cao nhất
            ->orderBy('updated_at') 
            ->paginate(20);

        return view('scoreboards', compact('leaderboard'));
    }
}
