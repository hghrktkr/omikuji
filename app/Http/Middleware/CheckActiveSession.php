<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CheckActiveSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){

            // ユーザーのIDを取得
            $user_id = Auth::id();

            // クライアント側のセッションIDを取得
            $current_session_id = $request->session()->getId();
            // dd($current_session_id);

            // sessionsテーブルに同一ユーザーの別セッションIDが無いか確認
            $same_user_session_ids = DB::table('sessions')->where([
                ['user_id', '=', $user_id],
                ['id', '<>', $current_session_id]
                ])->get();

            // 同一ユーザーの別セッションIDがある場合
            if($same_user_session_ids->isNotEmpty()){
                // 一致していないとき=二重ログイン時はログアウト
                Auth::logout();

                // ログインページへリダイレクト
                return redirect()->route('login')->witherrors(['message' => '別の端末でログインがありました']);
            }
        }
        return $next($request);
    }
}
