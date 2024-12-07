<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $field = $request->input('field', 'teamname');
        $searchQuery = $request->input('q');

        if (!in_array($field, ['teamname', 'website', 'group'])) {
            // Nếu trường tìm kiếm không hợp lệ, trả về tất cả các team
            return redirect()->route('teams');
        }

        if ($searchQuery) {
            // Sử dụng DB để tìm kiếm theo trường và từ khóa
            $teams = DB::table('teams')
                ->where($field, 'like', '%' . $searchQuery . '%')
                ->get();
        } else {
            $teams = DB::table('teams')->paginate(15);
        }
        // Trả về view với thông tin người dùng
        return view('teams', ['teams'=>$teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isMember = DB::table('team_members')
            ->where('name', Auth::user()->name)
            ->exists();
        if ($isMember) {
            return redirect()->route('teams.create')->with('error', 'You are already a member of this team.');
        }
        DB::table('teams')->insertGetId([
            'teamname' => $request->input('teamname'),
            'password' => Hash::make($request->input('password')),
            'team_leader' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm leader vào bảng `team_members` như là thành viên đầu tiên
        DB::table('team_members')->insert([
            'teamname' => $request->input('teamname'),
            'name' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')
            ->where('name', Auth::user()->name)
            ->update([
            'team' => $request->input('teamname'),
            'updated_at' => now(),
        ]);
        return redirect('home');
    }

    public function show()
    {
        return view('teams.join');
    }

    // Hàm để tham gia team
    public function joinTeam(Request $request)
    {
        $teamname = $request->input('teamname');
        $password = $request->input('password');
        // Kiểm tra xem người dùng đã là thành viên của team chưa
        $isMember = DB::table('team_members')
            ->where('name', Auth::user()->name)
            ->exists();

        if ($isMember) {
            return redirect()->route('teams.join')->with('error', 'You are already a member of this team.');
        }

        $team = DB::table('teams')->where('teamname', $teamname)->first();

        // Thêm người dùng vào team
        if($team && Hash::check($password, $team->password)){
            DB::table('team_members')->insert([
                'teamname' => $request->input('teamname'),
                'name' => Auth::user()->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')
                ->where('name', Auth::user()->name)
                ->update([
                'team' => $request->input('teamname'),
                'updated_at' => now(),
            ]);

            return redirect('home');
        }
        else {
            return redirect()->route('teams.join')->with('error', 'Wrong team name or password!.');
        }
    }

    public function teamIndex()
    {
        $teams = DB::table('teams')->where('teamname', Auth::user()->team)->first();
        $members = DB::table('team_members')->where('teamname', Auth::user()->team)->get();
        $check = DB::table('team_members')->where('name', Auth::user()->name)->first();
        $submissions = DB::table('challengesubmission')->where('name', Auth::user()->team)->get();
        if($check){
            return view('teams.team', ['teams'=>$teams, 'members' => $members, 'submissions' => $submissions]);
        }
        else {
            return redirect()->route('home');
        }
    }

    public function edit(string $teamname)
    {
        $team = DB::table('teams')->where('teamname',$teamname)->first();
        $team_member = DB::table('team_members')->where('teamname',$teamname)->get();
        return view('teams.edit',['team'=>$team], ['team_member'=>$team_member]);
    }

    public function update(Request $request, $teamname)
    {
        $currentData = DB::table('teams')->where('teamname', $teamname)->first();

        $params = [];

        if ($currentData->teamname !== $request->input('teamname')) {
            $params['teamname'] = $request->input('teamname');
        }
        if ($currentData->password !== $request->input('password')) {
            $params['password'] = Hash::make($request->input('password'));
        }
        if ($currentData->team_leader !== $request->input('team_leader')) {
            $params['team_leader'] = $request->input('team_leader');
        }
        if ($currentData->website !== $request->input('website')) {
            $params['website'] = $request->input('website');
        }
        if ($currentData->group !== $request->input('group')) {
            $params['group'] = $request->input('group');
        }
        if ($currentData->country !== $request->input('country')) {
            $params['country'] = $request->input('country');
        }

        if (!empty($params)) {
            DB::table('teams')->where('teamname', $teamname)->update($params);
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $team = DB::table('teams')->where('team_leader',Auth::user()->name)->first();
        if($team){
            DB::table('teams')->where('teamname',Auth::user()->team)->delete();
            DB::table('team_members')->where('teamname',Auth::user()->team)->delete();
            DB::table('challengesubmission')->where('name', Auth::user()->team)->delete();
            DB::table('users')->where('team', Auth::user()->team)->update(['team' => null, 'score' => 0]);
            return redirect()->route('home');
        }
        else {
            return redirect()->route('teams.team');
        }
    }

    public function Outteam()
    {
        DB::table('users')->where('name', Auth::user()->name)->update(['team' => null, 'score' => 0]);
        DB::table('team_members')->where('name', Auth::user()->name)->delete();
        return redirect()->route('home');
    }
}
