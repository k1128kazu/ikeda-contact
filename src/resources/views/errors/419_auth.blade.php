@extends('layouts.app')

@section('title', 'セッションが切れました')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-card">

    <p class="auth-expired">
        セッションの有効期限が切れました。<br>
        もう一度ログインしてください。
    </p>

    <div class="auth-actions">
        <a href="{{ route('login') }}" class="auth-btn">
            ログイン画面へ
        </a>
    </div>

</div>
@endsection