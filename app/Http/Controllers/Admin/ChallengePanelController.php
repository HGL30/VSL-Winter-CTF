<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class ChallengePanelController extends Controller
{
    public function index(){
        $challenges = DB::table('challenges')->paginate(15);

        return view('admin.challengepanel', ['challenges'=>$challenges]);
    }

    public function edit(string $name)
    {
        $challenge = DB::table('challenges')->where('challenge_name',$name)->first();
        return view('admin.challenge.edit',['challenge'=>$challenge]);
    }

    public function update(Request $request, $name)
    {
        $name = $request->input('name');
        $currentLabData = DB::table('challenges')->where('challenge_name', $name)->first();
        $params = [];
        // Chỉ thêm trường vào $params nếu giá trị mới khác giá trị hiện tại
        if ($currentLabData->challenge_name !== $request->input('name')) {
            $params['challenge_name'] = $request->input('name');
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
        if ($request->input('file') !== null && $currentLabData->file !== $request->input('file')) {
            $filePath = null;
            $file = $request->file('file');
            if (!$file->isValid()) {
                return back()->withErrors(['file' => 'File không hợp lệ.']);
            }
            $filePath = $file->store('challenges', 'public/files');
            $params['file'] = $filePath;
        }
        if (!$currentLabData->link || $currentLabData->link !== $request->input('link')) {
            $params['link'] = $request->input('link');
        }
        if ($currentLabData->flag !== $request->input('flag')) {
            $params['flag'] = $request->input('flag');
        }
        if ($currentLabData->points !== $request->input('points')) {
            $params['points'] = $request->input('points');
        }
        if (!empty($params)) {
            $params['updated_at'] = \Carbon\Carbon::now();
            DB::table('challenges')->where('challenge_name', $name)->update($params);
        }

        return redirect()->route('admin.challengepanel');
    }

    public function create()
    {
        return view('admin.challenge.create');
    }

    public function store(Request $request)
    {
        $filePath = '';

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('challenges', 'public'); // Lưu file vào thư mục 'storage/app/public/challenges'
        }

        $params1 = [
            'challenge_name'=>$request->input('name'),
            'difficulty'=>$request->input('difficulty'),
            'description'=>$request->input('description'),
            'type'=>$request->input('type'),
            'file'=>$filePath,
            'link'=>$request->input('link'),
            'flag'=>$request->input('flag'),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];

        DB::table('challenges')->insert($params1);  
        return redirect()->route('admin.challengepanel');
    }

    public function destroy(string $name)
    {
        $file = DB::table('challenges')->where('challenge_name',$name)->first();
        $filePath = 'public/' . $file->file;
        if($file->file){
            Storage::delete($filePath);
        }
        DB::table('challenges')->where('challenge_name',$name)->delete();
        return redirect()->route('admin.challengepanel');
    }
}
