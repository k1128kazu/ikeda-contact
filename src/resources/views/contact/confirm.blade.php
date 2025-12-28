@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

<div class="contact-wrapper">
    <h1 class="page-title">Confirm</h1>

    <div class="confirm-box">
        {{-- お名前 --}}
        <div class="form-row">
            <div class="form-label">お名前</div>
            <div class="form-input">
                {{ $data['last_name'] }} {{ $data['first_name'] }}
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form-row">
            <div class="form-label">性別</div>
            <div class="form-input">
                {{ $data['gender_text'] }}
            </div>
        </div>

        {{-- メール --}}
        <div class="form-row">
            <div class="form-label">メールアドレス</div>
            <div class="form-input">
                {{ $data['email'] }}
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-row">
            <div class="form-label">電話番号</div>
            <div class="form-input">
                {{ $data['tel'] }}
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-row">
            <div class="form-label">住所</div>
            <div class="form-input">
                {{ $data['address'] }}
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form-row">
            <div class="form-label">建物名</div>
            <div class="form-input">
                {{ $data['building'] ?? '' }}
            </div>
        </div>

        {{-- 種類 --}}
        <div class="form-row">
            <div class="form-label">お問い合わせの種類</div>
            <div class="form-input">
                {{ $data['category_text'] }}
            </div>
        </div>

        {{-- 内容 --}}
        <div class="form-row">
            <div class="form-label">お問い合わせ内容</div>
            <div class="form-input">
                {{ $data['detail'] }}
            </div>
        </div>
    </div>

    {{-- ボタン --}}
    <div class="form-submit confirm-actions">
        {{-- 左：送信 --}}
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
            <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
            <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}">
            <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">
            <button type="submit" class="btn-main">送信</button>
        </form>

        {{-- 右：修正 --}}
        <form action="{{ route('contact.back') }}" method="POST">
            @csrf
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel1" value="{{ $data['tel1'] }}">
            <input type="hidden" name="tel2" value="{{ $data['tel2'] }}">
            <input type="hidden" name="tel3" value="{{ $data['tel3'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}">
            <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">
            <button type="submit" class="btn-sub">修正</button>
        </form>
    </div>

</div>
@endsection