@extends('layouts.app')

@section('content')
<style>
    .wrap {
        width: 920px;
        margin: 30px auto;
    }

    .h {
        text-align: center;
        color: #8b7969;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .box {
        border: 1px solid #eee5df;
        padding: 20px;
    }

    .row {
        display: flex;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f2ebe6;
    }

    .k {
        width: 220px;
        background: #8b7969;
        color: #fff;
        padding: 10px;
        font-size: 12px;
    }

    .v {
        flex: 1;
        padding: 10px;
        font-size: 12px;
        color: #6b5f55;
    }

    .back {
        display: inline-block;
        margin-top: 18px;
        padding: 8px 16px;
        background: #8b7969;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
    }
</style>

<div class="wrap">
    <div class="h">Admin - 詳細</div>
    <div class="box">
        @php $genderMap=[1=>'男性',2=>'女性',3=>'その他']; @endphp

        <div class="row">
            <div class="k">お名前</div>
            <div class="v">{{ $contact->last_name }} {{ $contact->first_name }}</div>
        </div>
        <div class="row">
            <div class="k">性別</div>
            <div class="v">{{ $genderMap[$contact->gender] ?? '' }}</div>
        </div>
        <div class="row">
            <div class="k">メールアドレス</div>
            <div class="v">{{ $contact->email }}</div>
        </div>
        <div class="row">
            <div class="k">電話番号</div>
            <div class="v">{{ $contact->tel }}</div>
        </div>
        <div class="row">
            <div class="k">住所</div>
            <div class="v">{{ $contact->address }}</div>
        </div>
        <div class="row">
            <div class="k">建物名</div>
            <div class="v">{{ $contact->building }}</div>
        </div>
        <div class="row">
            <div class="k">お問い合わせの種類</div>
            <div class="v">{{ optional($contact->category)->content }}</div>
        </div>
        <div class="row">
            <div class="k">お問い合わせ内容</div>
            <div class="v" style="white-space:pre-wrap;">{{ $contact->detail }}</div>
        </div>
    </div>

    <a class="back" href="{{ route('admin.contacts.index') }}">戻る</a>
</div>
@endsection