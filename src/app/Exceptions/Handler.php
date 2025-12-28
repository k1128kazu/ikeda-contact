<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e)
    {
        // ▼ 419 セッション切れ共通判定
        if (
            $e instanceof TokenMismatchException ||
            ($e instanceof HttpException && $e->getStatusCode() === 419)
        ) {

            // contact（一般ユーザー）
            if ($request->is('contact*') || $request->is('confirm') || $request->is('thanks')) {
                return response()->view('errors.419_contact', [], 419);
            }

            // admin 管理画面
            if ($request->is('admin*')) {
                return response()->view('errors.419_admin', [], 419);
            }

            // 認証 login / register
            if ($request->is('login') || $request->is('register')) {
                return response()->view('errors.419_auth', [], 419);
            }

            // その他は contact 版にフォールバック
            return response()->view('errors.419_contact', [], 419);
        }
        if ($e instanceof ThrottleRequestsException) {
            // 画面表示（HTML）のときはバリデーション扱いにする
            if (!$request->expectsJson()) {
                throw ValidationException::withMessages([
                    'email' => 'ログイン試行が多すぎます。少し待ってから再度お試しください。',
                ]);
            }
        }

        return parent::render($request, $e);
    }
}
