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

            // ユーザーIDに該当する最新のセッション情報を取得
            $latest_session = DB::table('sessions')
                                ->where('user_id', $user_id)
                                ->orderBy('last_activity', 'desc')
                                ->first();
            
            // クライアントのセッションIDと、最新のセッションIDを比較
            if($latest_session && $latest_session->id !== $current_session_id){
                // 最新でない場合ログアウト
                Auth::logout();

                // 該当セッション情報を無効化
                $request->session()->invalidate();

                // ログインページへリダイレクト
                return redirect()->route('login')->with('message', '別の端末でログインがありました');
            }else{
                // クライアントのセッションIDが最新の場合、タイムスタンプを更新
                DB::table('sessions')
                    ->where('id', $current_session_id)
                    ->update(['last_activity' => now()->timestamp]);

                // 最新であるクライアント以外のセッション情報を削除->既ログインクライアントのCSRFトークンも消えるので419エラーになる！
                // DB::table('sessions')
                //     ->where([
                //         ['user_id', '=', $user_id],
                //         ['id', '<>', $current_session_id]
                //         ])
                //     ->delete();
            };
        }
        return $next($request);
    }
}
