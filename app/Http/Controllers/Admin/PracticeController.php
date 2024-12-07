<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PracticeController extends Controller
{
    public function index(){
        $labs = DB::table('labs')->paginate(15);
        return view('admin.practicepanel', ['labs'=>$labs]);
    }

    public function create()
    {
        return view('admin.practice.create');
    }

    public function store(Request $request)
    {
        $filePath = '';

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public'); // Lưu file vào thư mục 'storage/app/public/files'
        }
        $params1 = [
            'name'=>$request->input('name'),
            'difficulty'=>$request->input('difficulty'),
            'description'=>$request->input('description'),
            'type'=>$request->input('type'),
            'file'=>$filePath,
            'link'=>$request->input('link'),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];

        $params2 = [
            'challenge_name'=>$request->input('name'),
            'flag'=>$request->input('flag'),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];

        DB::table('labs')->insert($params1);
        DB::table('flags')->insert($params2);   
        return redirect()->route('admin.practicepanel');
    }

    public function destroy(string $name)
    {
        DB::table('labs')->where('name',$name)->delete();
        DB::table('flags')->where('challenge_name',$name)->delete();
        return redirect()->route('admin.practicepanel');
    }

    public function edit(string $name)
    {
        $lab = DB::table('labs')->where('name',$name)->first();
        $flag = DB::table('flags')->where('challenge_name',$name)->first();
        return view('admin.practice.edit',['lab'=>$lab], ['flag'=>$flag]);
    }

    public function update(Request $request, $name)
    {
        $name = $request->input('name');
        // Lấy dữ liệu hiện tại từ CSDL
        $currentLabData = DB::table('labs')->where('name', $name)->first();
        $currentFlagData = DB::table('flags')->where('challeng_name', $name)->first();

        $params = [];
        $params2 = [];

        // Chỉ thêm trường vào $params nếu giá trị mới khác giá trị hiện tại
        if ($currentLabData->name !== $request->input('name')) {
            $params['name'] = $request->input('name');
        }
        if ($currentLabData->difficulty !== $request->input('difficulty')) {
            $params['difficulty'] = $request->input('difficulty');
        }
        if ($currentLabData->description !== $request->input('description')) {
            $params['description'] = $request->input('description');
        }
        if ($currentLabData->type !== $request->input('type')) {
            $params['type'] = $request->input('type');
        }
        if ($currentLabData->file !== $request->input('file')) {
            $filePath = '';

            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('files', 'public'); // Lưu file vào thư mục 'storage/app/public/challenges'
            }
            $params['file'] = $filePath;
        }

        if (!$currentLabData->link || $currentLabData->link !== $request->input('link')) {
            $params['link'] = $request->input('link');
        }

        // Tương tự cho bảng flags
        if ($currentFlagData->challenge_name !== $request->input('name')) {
            $params2['name'] = $request->input('name');
        }
        if ($currentFlagData->flag !== $request->input('flag')) {
            $params2['flag'] = $request->input('flag');
        }

        // Chỉ thực hiện update nếu $params và $params2 không rỗng
        if (!empty($params)) {
            $params['updated_at'] = \Carbon\Carbon::now();
            DB::table('labs')->where('name', $name)->update($params);
        }
        if (!empty($params2)) {
            $params2['updated_at'] = \Carbon\Carbon::now();
            DB::table('flags')->where('challenge_name', $name)->update($params2);
        }

        return redirect()->route('admin.practicepanel');

    }
}
