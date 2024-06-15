<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ログイン時にsessionsテーブルにガードの情報を追加(一般ユーザーと管理者をsessions上で区別するため)
        Event::listen(Login::class, function ($event) {
            $session = session();
            $session->put('guard', $event->guard);
            $session->save();
        });

        Event::listen(Logout::class, function ($event) {
            $session = session();
            $session->forget('guard');
            $session->save();
        });
    }
}
