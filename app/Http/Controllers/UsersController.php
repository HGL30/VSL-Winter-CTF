<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $field = $request->input('field', 'name');
        $searchQuery = $request->input('username');

        if (!in_array($field, ['name', 'website', 'group'])) {
            // Nếu trường tìm kiếm không hợp lệ, trả về tất cả các team
            return redirect()->route('users');
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
        return view('users', ['users'=>$users]);
    }

    public function userIndex(String $name)
    {
        $users = DB::table('users')->where('name', $name)->first();
        $submissions = DB::table('submissions')->where('name', $name)->get();
        return view('users.user', ['users'=>$users, 'submissions' => $submissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = DB::table('users')->where('name', Auth::user()->name)->first();
        return view('users.setting',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
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
        if ($currentData->website !== $request->input('website')) {
            $params['website'] = $request->input('website');
        }
        if ($currentData->group !== $request->input('group')) {
            $params['group'] = $request->input('group');
        }

        if ($currentData->name !== $request->input('name')) {
            $params['name'] = $request->input('name');
        }
        if ($currentData->country !== $request->input('country')) {
            $params['country'] = $request->input('country');
        }

        if (!empty($params)) {
            DB::table('users')->where('name', $name)->update($params);
        }
        return redirect()->route('users.setting')->with('success', 'All information has been changed !');
    }
}
