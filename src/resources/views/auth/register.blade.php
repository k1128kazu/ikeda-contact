@extends('layouts.app')

@section('title', 'Register')

@section('content')
<h1 class="auth-page-title">Register</h1>

<div class="auth-card">
    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- お名前 --}}
        <div class="auth-group">
            <label class="auth-label">お名前</label>
            <input
                type="text"
                name="name"
                class="auth-input"
                value="{{ old('name') }}"
                placeholder="例: 山田 太郎">

            @error('name')
            <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

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

        {{-- パスワード確認（仕様に無い場合は非表示のまま） --}}
        {{--
        <div class="auth-group">
            <label class="auth-label">パスワード確認</label>
            <input
                type="password"
                name="password_confirmation"
                class="auth-input"
                placeholder="もう一度入力してください">

            @error('password_confirmation')
                <div class="auth-error">{{ $message }}
</div>
@enderror
</div>
--}}

<div class="auth-actions">
    <button type="submit" class="auth-btn">
        登録
    </button>
</div>

</form>
</div>
@endsection