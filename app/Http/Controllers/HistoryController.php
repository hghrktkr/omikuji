<?php

namespace App\Http\Controllers;
use App\Models\History;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function show_history(){
        $histories = History::all()->reverse();
        return view('omikuji.history', compact('histories'));
    }
}
