@extends('layouts.app')

@section('title', 'Login')


@section('content')
<h1 class="auth-page-title">Login</h1>

<div class="auth-card">
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- メールアドレス --}}
        <div class="auth-group">
            <label class="auth-label">メールアドレス</label>
            <input
                type="email"
                name="email"
                class="auth-input"
                value="{{ old('email') }}"
                placeholder="例: test@example.com">
            @error('email')
            <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード --}}
        <div class="auth-group">
            <label class="auth-label">パスワード</label>
            <input
                type="password"
                name="password"
                class="auth-input"
                placeholder="例: coachtech1106">

            @error('password')
            <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- ボタン --}}
        <div class="auth-actions">
            <button type="submit" class="auth-btn">
                ログイン
            </button>
        </div>
    </form>
</div>
@endsection