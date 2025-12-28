@extends('layouts.app')

@section('content')
<style>
    /* ===== Thanks Page（このページだけ強制適用） ===== */
    .thanks {
        position: relative;
        height: calc(100vh - 120px);
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        overflow: hidden;
    }

    .thanks__bg {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-size: 200px;
        font-family: serif;
        font-weight: 700;
        color: rgba(139, 121, 105, 0.08);
        /* 薄いブラウン */
        white-space: nowrap;
        margin: 0;
        line-height: 1;
        pointer-events: none;
        user-select: none;
        z-index: 0;
    }

    .thanks__inner {
        position: relative;
        text-align: center;
        z-index: 1;
    }

    .thanks__message {
        margin: 0 0 28px;
        font-size: 16px;
        font-weight: 700;
        color: #8b7969;
    }

    .thanks__home {
        display: inline-block;
        padding: 10px 42px;
        background: #8b7969;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        line-height: 1;
    }

    .thanks__home:hover {
        opacity: .85;
    }
</style>

<div class="thanks">
    {{-- 背景（前面文言ではない） --}}
    <p class="thanks__bg" aria-hidden="true">Thank you</p>

    <div class="thanks__inner">
        {{-- 前面は日本語のみ（仕様どおり） --}}
        <p class="thanks__message">お問い合わせありがとうございました</p>

        <a class="thanks__home" href="{{ route('contact.index') }}">HOME</a>
    </div>
</div>
@endsection