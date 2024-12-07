<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChallengesController extends Controller
{
    public function index(){
        $check = DB::table('team_members')->where('name', Auth::user()->name)->first();
        $checkchall = DB::table('challenges')->get();

        $challenges = DB::table('challenges')->get();
        if($check){
            return view('challenges', compact('challenges'));
        }
        else {
            return redirect()->route('home');
        }
    }

    public function show($name)
    {
        // Lấy thông tin challenge và các flag tương ứng
        $challenge = DB::table('challenges')->where('challenge_name', $name)->first();
        return view('challenge.show', compact('challenge'));
    }

    public function download($name)
    {
        // Truy xuất thông tin file từ bảng 'challenges' dựa trên id
        $challenge = DB::table('challenges')->where('challenge_name', $name)->first();

        if (!$challenge || !$challenge->file) {
            return redirect()->back()->with('error', 'File không tồn tại.');
        }

        $filePath = storage_path('app/public/' . $challenge->file);

        // Trả về file để tải về
        return response()->download($filePath);
    }

    public function submitFlag(Request $request, $challname)
    {
        $flagInput = $request->input('flag');

        $submission = DB::table('challengesubmission')
                ->where('challenge_name', $challname)
                ->where('name', Auth::user()->team)
                ->first();
        if ($submission) {
            if ($submission->locked == 1) {
                return redirect()->route('challenge.show', $challname)->with('success', 'You have already solved this challenge.');
            }
        }
        // Lấy flag từ database
        $flag = DB::table('challenges')
                    ->where('challenge_name', $challname)
                    ->first();

        if(Auth::check()){
            $team = Auth::user()->team;
        }

        // Lưu kết quả vào bảng `submissions`
        if($flagInput === $flag->flag){
            $currentTeamPoint = DB::table('teams')->where('teamname', Auth::user()->team)->first();
            $currentMemberPoint = DB::table('users')->where('name', Auth::user()->name)->first();
            DB::table('teams')->where('teamname', Auth::user()->team)->update(['score'=> $currentTeamPoint->score + $flag->points]);
            DB::table('users')->where('name', Auth::user()->name)->update(['score'=> $currentMemberPoint->score + $flag->points]);
            DB::table('challengesubmission')->insert([
                'name' => $team,
                'challenge_name' => $challname,
                'flag' => $flagInput,
                'type' => $flag->type,
                'value' => $flag->points,
                'correct' => 1,
                'locked' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if($flag->points > 100){
                DB::table('challenges')->where('challenge_name', $challname)->update(['points'=> $flag->points - 10]);
            }
        }

        // Thông báo kết quả
        if ($flagInput === $flag->flag) {
            return redirect()->route('challenge.show', $challname)->with('success', 'Congratulations! You found the correct flag.');
        } else {
            return redirect()->route('challenge.show', $challname)->with('error', 'Incorrect flag. Please try again.');
        }
    }
}
