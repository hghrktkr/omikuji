<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Item;

class AdminUserEditController extends Controller
{
    
    // 初期画面表示、users:教室名一覧
    public function index() {

        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }

    public function edit(Request $request) {

        // 選択したユーザーのemailを取得、くじ一覧の再表示時にデフォルトでドロップダウンに表示
        $userEmail = $request->input('user_email');

        // 選択したユーザーIDのくじ一覧を取得
        $items = Item::where('email', $userEmail)->get();

        // 再検索用にもう一度教室名一覧を取得
        $users = User::all();

        return view('admin.dashboard', compact('users', 'userEmail', 'items'));
    }

    public function update(Request $request) {

        // 数値の変更があったかチェックするフラグ
        $is_message_saved = false;

        $userEmail = $request->input('user_email');

        // 更新した数字を取得
        $quantities = $request->input('quantities');

        // itemsのquantityを更新
        foreach ($quantities as $itemId => $quantity) {
            $item = Item::find($itemId);

            // アイテムが存在し、かつ数値の変更がある場合は保存してフラグをtrueに
            if ($item && $item->quantity != $quantity) {
                $item->quantity = $quantity;
                $item->save();
                $is_message_saved = true;
            }
        }

        // 変更があった場合はメッセージ内容を持ってリダイレクト
        if ($is_message_saved) {
            return redirect()->route('admin.dashboard.edit.get', ['user_email' => $userEmail])
                ->with('message', '情報が更新されました');
        }else {
            return redirect()->route('admin.dashboard.edit.get', ['user_email' => $userEmail]);
        }
    }
}
