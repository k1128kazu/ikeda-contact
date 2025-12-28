@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

<div class="contact-wrapper">
    <h1 class="page-title">Contact</h1>

    <form action="{{ route('contact.confirm') }}" method="POST" novalidate>
        @csrf

        {{-- お名前 --}}
        <div class="form-row">
            <div class="form-label">お名前<span>※</span></div>

            <div class="form-input name-split">

                {{-- 姓 --}}
                <div class="split-item">
                    <input type="text"
                        name="last_name"
                        placeholder="例 山田"
                        value="{{ old('last_name') }}">
                    @error('last_name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 名 --}}
                <div class="split-item">
                    <input type="text"
                        name="first_name"
                        placeholder="例 太郎"
                        value="{{ old('first_name') }}">
                    @error('first_name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- 性別 --}}
        <div class="form-row">
            <div class="form-label">性別<span>※</span></div>
            <div class="form-input gender">
                <label>
                    <input type="radio" name="gender" value="1"
                        {{ old('gender','1')=='1' ? 'checked' : '' }}>
                    男性
                </label>
                <label>
                    <input type="radio" name="gender" value="2"
                        {{ old('gender')=='2' ? 'checked' : '' }}>
                    女性
                </label>
                <label>
                    <input type="radio" name="gender" value="3"
                        {{ old('gender')=='3' ? 'checked' : '' }}>
                    その他
                </label>

                @error('gender')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- メール --}}
        <div class="form-row">
            <div class="form-label">メールアドレス<span>※</span></div>
            <div class="form-input">
                <input type="email" name="email" placeholder="例 test@example.com" value="{{ old('email') }}">

                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-row">
            <div class="form-label">電話番号<span>※</span></div>

            <div class="form-input tel-split">

                <div class="split-item">
                    <input type="text" name="tel1" value="{{ old('tel1') }}">
                </div>

                <span class="tel-dash">-</span>

                <div class="split-item">
                    <input type="text" name="tel2" value="{{ old('tel2') }}">
                </div>

                <span class="tel-dash">-</span>

                <div class="split-item">
                    <input type="text" name="tel3" value="{{ old('tel3') }}">
                </div>

                @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                <p class="error">電話番号を入力してください</p>
                @endif

            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-row">
            <div class="form-label">住所<span>※</span></div>
            <div class="form-input">
                <input type="text" name="address"
                    placeholder="例 東京都渋谷区千駄ヶ谷1-2-3"
                    value="{{ old('address') }}">

                @error('address')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form-row">
            <div class="form-label">建物名</div>
            <div class="form-input">
                <input type="text" name="building"
                    placeholder="例 千駄ヶ谷マンション101"
                    value="{{ old('building') }}">
            </div>
        </div>

        {{-- 種類 --}}
        <div class="form-row">
            <div class="form-label">お問い合わせの種類<span>※</span></div>
            <div class="form-input">
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>

                @error('category_id')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 内容 --}}
        <div class="form-row">
            <div class="form-label">お問い合わせ内容<span>※</span></div>
            <div class="form-input">
                <textarea name="detail"
                    placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>

                @error('detail')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 送信 --}}
        <div class="form-submit">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection