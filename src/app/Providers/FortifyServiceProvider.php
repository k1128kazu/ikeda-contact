<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;

// 追加
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->bind(
            CreatesNewUsers::class,
            CreateNewUser::class
        );

        /*
        |--------------------------------------------------------------------------
        | ログイン試行制限を無効化（課題・開発用）
        |--------------------------------------------------------------------------
        */
        RateLimiter::for('login', function () {
            return Limit::none();
        });

        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });

        /**
         * 認証処理（Laravel8 正式）
         */
        Fortify::authenticateUsing(function (Request $request) {
            // 入力チェック
            $request->validate(
                [
                    'email'    => ['required', 'email'],
                    'password' => ['required'],
                ],
                [
                    'email.required'    => __('validation.required', ['attribute' => 'メールアドレス']),
                    'email.email'       => __('validation.email', ['attribute' => 'メールアドレス']),
                    'password.required' => __('validation.required', ['attribute' => 'パスワード']),
                ]
            );

            // ユーザー取得
            $user = User::where('email', $request->email)->first();

            // ① ユーザー未登録 → メール欄に表示
            if (! $user) {
                throw ValidationException::withMessages([
                    'email' => __('validation.custom.login.not_found'),
                ]);
            }

            // ② パスワード不一致 → パスワード欄に表示
            if (! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => __('validation.custom.login.password_mismatch'),
                ]);
            }

            return $user;
        });    }
}
