<?php

namespace App\Http\Controllers;
use App\Models\History;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function add_history(Request $request){
        // resultで受け取った賞名と任意入力の名前をhistoriesテーブルに保存
        History::create([
            'rank_name' => $request->input('rank_name'),
            'student_name' => $request->input('student_name')
        ]);

        return Redirect::route('dashboard')->with('success','結果を保存しました！');
    }

    public function show_history(){
        $histories = History::all()->reverse();
        return view('omikuji.history', compact('histories'));
    }
}
