<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\History;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function omikuji_draw(Request $request){
        // DBから0でないおみくじを集めてコレクションにする
        $items = Item::where([
            ['quantity', '>', 0],
            ['email', '=', Auth::user()->email] //ログイン中のユーザー情報
            ])->get();

        if($items->isEmpty()){
            // くじを全部引いてしまったときの処理
            return view('omikuji.empty');
        }

        // くじののこり本数に応じて重み付け
        $rank_names =[];
        foreach($items as $item){
            for($i = 0; $i < $item->quantity; $i++){
                $rank_names[] = $item;
            }
        }

        // ランダムに引いたくじを変数へ
        $result_omikuji = $rank_names[array_rand($rank_names)];

        // 練習じゃなければ反映
        if($request->input('is_practice') != 1){
            // 引いたくじの本数を減らしてセーブ
            $result_omikuji->quantity -= 1;
            $result_omikuji->save();

            History::create([
                'rank_name' => $result_omikuji->rank_name,
                'student_name' => $request->input('student_name')
            ]);
        }

        // 表示するエンティティ画像をランダムに取得
        $image_right = Image::where('is_right', '1')->inRandomOrder()->first();
        $image_left = Image::where('is_right', '0')->inRandomOrder()->first();
        
        // 引いたくじのデータとともに結果画面へ
        return view('omikuji.result', compact('result_omikuji', 'image_right', 'image_left'));
    }
}
