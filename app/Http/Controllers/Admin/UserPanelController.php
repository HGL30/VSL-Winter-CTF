<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserPanelController extends Controller
{
    public function index(Request $request){
        $field = $request->input('field', 'name');
        $searchQuery = $request->input('username');

        if (!in_array($field, ['name', 'website', 'group'])) {
            // Nếu trường tìm kiếm không hợp lệ, trả về tất cả các user
            return redirect()->route('admin.userpanel');
        }

        if ($searchQuery) {
            // Sử dụng DB để tìm kiếm theo trường và từ khóa
            $users = DB::table('users')
                ->where($field, 'like', '%' . $searchQuery . '%')
                ->get();
        } else {
            $users = DB::table('users')->paginate(15);
        }

        // Trả về view với thông tin người dùng
        return view('admin.userpanel', ['users'=>$users]);
    }

    public function edit(string $name)
    {
        $user = DB::table('users')->where('name',$name)->first();
        return view('admin.user.edit',['user'=>$user]);
    }

    public function update(Request $request, $name)
    {
        $currentData = DB::table('users')->where('name', $name)->first();

        $params = [];

        if ($currentData->name !== $request->input('name')) {
            $params['name'] = $request->input('name');
        }
        if ($currentData->email !== $request->input('email')) {
            $params['email'] = $request->input('email');
        }
        if ($currentData->password !== $request->input('password') && $request->filled('password')) {
            $params['password'] = Hash::make($request->input('password'));
        }
        if ($currentData->role !== $request->input('role')) {
            $params['role'] = $request->input('role');
        }
        if ($currentData->score !== $request->input('score')) {
            $params['score'] = $request->input('score');
        }
        if (!empty($params)) {
            DB::table('users')->where('name', $name)->update($params);
        }
        return redirect()->route('admin.userpanel');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'role'=>$request->input('role'),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];
        DB::table('users')->insert($params);   
        return redirect()->route('admin.userpanel');
    }


    public function destroy(string $name)
    {
        DB::table('users')->where('name',$name)->delete();
        DB::table('team_members')->where('name',$name)->delete();
        return redirect()->route('admin.userpanel');
    }
}
