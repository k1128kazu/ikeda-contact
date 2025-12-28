@extends('layouts.app')

@section('title', 'セッション有効期限切れ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<div class="admin-wrapper">
    <h2 class="admin-title">お問い合わせ管理</h2>

    <div class="session-box">
        <p>
            一定時間操作が行われなかったため<br>
            管理画面のセッションが切断されました。
        </p>

        <div class="session-actions">
            <a href="{{ route('login') }}" class="session-btn">
                再ログインする
            </a>
        </div>
    </div>
</div>
@endsection