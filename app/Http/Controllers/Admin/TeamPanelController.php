<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class TeamPanelController extends Controller
{
    public function index(Request $request){
        $field = $request->input('field', 'teamname');
        $searchQuery = $request->input('q');

        if (!in_array($field, ['teamname', 'website', 'group'])) {
            // Nếu trường tìm kiếm không hợp lệ, trả về tất cả các team
            return redirect()->route('admin.teampanel');
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
        return view('admin.teampanel', ['teams'=>$teams]);
    }

    public function edit(string $teamname)
    {
        $team = DB::table('teams')->where('teamname',$teamname)->first();
        return view('admin.team.edit',['team'=>$team]);
    }

    public function update(Request $request, $teamname)
    {
        $currentData = DB::table('teams')->where('teamname', $teamname)->first();

        $params = [];

        if ($currentData->teamname !== $request->input('teamname')) {
            $params['teamname'] = $request->input('teamname');
        }
        if ($currentData->group !== $request->input('group')) {
            $params['group'] = $request->input('group');
        }
        if ($currentData->password !== $request->input('password') && $request->filled('password')) {
            $params['password'] = Hash::make($request->input('password'));
        }
        if ($currentData->score !== $request->input('score')) {
            $params['score'] = $request->input('score');
        }
        if (!empty($params)) {
            DB::table('teams')->where('teamname', $teamname)->update($params);
        }
        return redirect()->route('admin.teampanel');
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $params = [
            'teamname'=>$request->input('teamname'),
            'password'=>Hash::make($request->input('password')),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];
        DB::table('teams')->insert($params);   
        return redirect()->route('admin.teampanel');
    }


    public function destroy(string $teamname)
    {
        DB::table('teams')->where('teamname',$teamname)->delete();
        DB::table('team_members')->where('teamname',$teamname)->delete();
        DB::table('challengesubmission')->where('name', $teamname)->delete();
        DB::table('users')->where('team', $teamname)->update(['team' => null, 'score' => 0]);
        return redirect()->route('admin.teampanel');
    }
}
