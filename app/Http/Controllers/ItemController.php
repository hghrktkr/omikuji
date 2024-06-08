<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(){
        return view('omikuji.index');
    }

    public function omikuji_draw(){
        // DBから0でないおみくじを集めてコレクションにする
        $items = Item::where([
            ['quantity', '>', 0],
            ['email', '=', Auth::user()->email] //ログイン中のユーザー情報どうやって取得？
            ])->get();

        if($items->isEmpty()){
            // くじを全部引いてしまったときの処理
        }

        // ランダムに引いたくじを変数へ
        $result_omikuji = $items->random();

        // 引いたくじの本数を減らす
        $result_omikuji->quantity -= 1;
        $result_omikuji->save();

        // 引いたくじのデータとともに結果画面へ
        return view('omikuji.result', compact('result_omikuji'));
    }
}
