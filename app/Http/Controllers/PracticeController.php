<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;

class PracticeController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
    
        if ($type) {
            $labs = DB::table('labs')->where('type', $type)->get();
        } else {
            $labs = DB::table('labs')->get();
        }
        return view('practices', compact('labs'));
    }

    public function show($name)
    {
        // Lấy thông tin challenge và các flag tương ứng
        $lab = DB::table('labs')->where('name', $name)->first();
        $flags = DB::table('flags')->where('challenge_name', $name)->get();
        return view('lab.show', compact('lab', 'flags'));
    }

    public function Practicedownload($name)
    {
        // Truy xuất thông tin file từ bảng 'labs' dựa trên id
        $lab = DB::table('labs')->where('name', $name)->first();

        if (!$lab || !$lab->file) {
            return redirect()->back()->with('error', 'File không tồn tại.');
        }

        $filePath = storage_path('app/public/' . $lab->file);

        // Trả về file để tải về
        return response()->download($filePath);
    }

    public function submitFlag(Request $request, $labname)
    {
        $flagInput = $request->input('flag');

        $submission = DB::table('submissions')
                ->where('lab_name', $labname)
                ->where('name', Auth::user()->name)
                ->first();
        if ($submission) {
            if ($submission->locked == 1) {
                return redirect()->route('lab.show', $labname)->with('success', 'You have already solved this challenge.');
            }
        }
        // Lấy flag từ database
        $flag = DB::table('flags')
                    ->where('challenge_name', $labname)
                    ->first();
        $lab = DB::table('labs')
                    ->where('name', $labname)
                    ->first();
        if(Auth::check()){
            $name = Auth::user()->name;
        }

        // Lưu kết quả vào bảng `submissions`
        if($flagInput === $flag->flag){
            DB::table('submissions')->insert([
                'name' => $name,
                'lab_name' => $labname,
                'flag' => $flagInput,
                'type' => $lab->type,
                'difficulty' => $lab->difficulty,
                'correct' => 1,
                'locked' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Thông báo kết quả
        if ($flagInput === $flag->flag) {
            return redirect()->route('lab.show', $labname)->with('success', 'Congratulations! You found the correct flag.');
        } else {
            return redirect()->route('lab.show', $labname)->with('error', 'Incorrect flag. Please try again.');
        }
    }
}
