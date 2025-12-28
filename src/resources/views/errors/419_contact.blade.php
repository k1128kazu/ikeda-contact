@extends('layouts.app')

@section('title', 'セッションが切れました')

@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

<div class="contact-wrapper">

    <h1 class="page-title">Contact</h1>

    <div class="session-box">

        <p class="session-message">
            一定時間操作が行われなかったため、<br>
            安全のためフォームを再読み込みしました。
        </p>

        <div class="session-actions">
            <a href="{{ route('contact.index') }}" class="session-btn">
                入力画面に戻る
            </a>
        </div>

    </div>

</div>
@endsection