<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            $user_id = Auth::user()->id;
            dd($user_id);
            // sessionsテーブルのセッションIDを取得
            $session_id = Session::getId();

            // ログイン中のユーザーのセッションIDと、送信されているセッションIDを比較
            if($active_session_id !== $session_id){
                // 一致していないとき=二重ログイン時はログアウト
                Auth::logout();

                // ログインページへリダイレクト
                return redirect()->route('login')->witherrors(['message' => '別の端末でログインがありました']);
            }
        }
        return $next($request);
    }
}
