@extends('layouts.app')

@section('content')
<style>
    /* ===== Admin（スクショ準拠） ===== */
    .admin-page {
        width: 100%;
    }

    .admin-inner {
        width: 980px;
        margin: 30px auto 60px;
    }

    .admin-title {
        text-align: center;
        font-size: 22px;
        font-weight: 700;
        color: #8b7969;
        margin: 10px 0 22px;
        letter-spacing: .02em;
    }

    .admin-topbar {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 920px;
        margin: 0 auto;
    }

    .admin-logout {
        border: 1px solid #e6dcd5;
        background: #fff;
        color: #8b7969;
        padding: 6px 16px;
        font-size: 12px;
        cursor: pointer;
    }

    .admin-logout:hover {
        opacity: .85;
    }

    .search-row {
        display: flex;
        gap: 14px;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        flex-wrap: nowrap;
        /* ★ 折り返し禁止 */
    }

    .search-input,
    .search-select,
    .search-date {
        height: 34px;
        border: 1px solid #e6dcd5;
        background: #fff;
        padding: 0 10px;
        font-size: 12px;
        color: #6b5f55;
        box-sizing: border-box;
        flex: 0 0 auto;
        /* ★ 勝手に縮まない */
    }

    .search-input {
        width: 300px;
    }

    /* ★ 少し広げる */
    .search-select {
        width: 150px;
    }

    .search-date {
        width: 140px;
    }

    .search-btn {
        height: 34px;
        width: 64px;
        /* ★ 固定で1行に */
        border: none;
        background: #8b7969;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        flex: 0 0 auto;
    }

    .reset-btn {
        height: 34px;
        width: 64px;
        /* ★ 固定で1行に */
        border: none;
        background: #d7c7bc;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        flex: 0 0 auto;
        display: inline-flex;
        /* ★ 文字が折れない */
        align-items: center;
        justify-content: center;
        text-decoration: none;
        white-space: nowrap;
        /* ★ 「リセット」改行防止 */
    }

    .search-btn:hover,
    .reset-btn:hover {
        opacity: .85;
    }

    .admin-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 14px 0 10px;
    }

    .export-btn {
        border: 1px solid #e6dcd5;
        background: #f6f1ee;
        color: #8b7969;
        padding: 8px 16px;
        font-size: 12px;
        text-decoration: none;
    }

    .export-btn:hover {
        opacity: .85;
    }

    .pager-top {
        font-size: 12px;
        color: #8b7969;
    }

    .pager-top .pagination {
        margin: 0;
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .pager-top .page-item {
        list-style: none;
    }

    .pager-top .page-link {
        display: inline-block;
        padding: 6px 10px;
        border: 1px solid #e6dcd5;
        text-decoration: none;
        color: #8b7969;
        background: #fff;
    }

    .pager-top .active .page-link {
        background: #8b7969;
        color: #fff;
        border-color: #8b7969;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #eee5df;
    }

    .admin-table thead th {
        background: #8b7969;
        color: #fff;
        font-weight: 700;
        font-size: 12px;
        padding: 12px 10px;
        text-align: left;
    }

    .admin-table tbody td {
        font-size: 12px;
        color: #6b5f55;
        padding: 12px 10px;
        border-top: 1px solid #efe7e1;
    }

    .detail-btn {
        display: inline-block;
        border: 1px solid #e6dcd5;
        background: #fff;
        color: #8b7969;
        padding: 6px 14px;
        font-size: 12px;
        text-decoration: none;
    }

    .detail-btn:hover {
        opacity: .85;
    }

    .col-detail {
        width: 90px;
        text-align: right;
    }
</style>

<div class="admin-page">

    {{-- ヘッダー右：logout（スクショ準拠） --}}
    <div class="admin-topbar">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="admin-logout">logout</button>
        </form>
    </div>

    <div class="admin-inner">
        <h2 class="admin-title">Admin</h2>

        {{-- 検索（スクショの並び） --}}
        <form method="GET" action="{{ route('admin.contacts.index') }}">
            <div class="search-row">
                <input class="search-input" type="text" name="keyword"
                    placeholder="名前やメールアドレスを入力してください"
                    value="{{ request('keyword') }}">

                <select class="search-select" name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select class="search-select" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->content }}
                    </option>
                    @endforeach
                </select>

                <input class="search-date" type="date" name="date" value="{{ request('date') }}">

                <button class="search-btn" type="submit">検索</button>
                <button class="reset-btn" type="button"
                    onclick="window.location='{{ route('admin.contacts.index') }}'">
                    リセット
                </button>
            </div>
        </form>

        <div class="admin-actions">
            <a class="export-btn" href="{{ route('admin.contacts.export', request()->query()) }}">エクスポート</a>
            <div class="pager-top">
                {{ $contacts->links('vendor.pagination.admin') }}
            </div>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th class="col-detail"></th>
                </tr>
            </thead>
            <tbody>
                @php
                $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
                @endphp

                @forelse($contacts as $c)
                <tr>
                    <td>{{ $c->last_name }} {{ $c->first_name }}</td>
                    <td>{{ $genderMap[$c->gender] ?? '' }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ optional($c->category)->content }}</td>
                    <td class="col-detail">
                        <button
                            type="button"
                            class="detail-btn js-open-detail"
                            data-id="{{ $c->id }}"
                            data-name="{{ $c->last_name }} {{ $c->first_name }}"
                            data-gender="{{ $c->gender }}"
                            data-email="{{ $c->email }}"
                            data-tel="{{ $c->tel }}"
                            data-address="{{ $c->address }}"
                            data-building="{{ $c->building }}"
                            data-category="{{ optional($c->category)->content }}"
                            data-detail="{{ $c->detail }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">データがありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- 詳細モーダル --}}
<div class="admin-modal" id="adminDetailModal" aria-hidden="true">
    <div class="admin-modal__overlay js-close-detail"></div>

    <div class="admin-modal__content" role="dialog" aria-modal="true" aria-labelledby="adminDetailTitle">
        <button type="button" class="admin-modal__close js-close-detail" aria-label="close">×</button>
        <h2 class="admin-modal__title" id="adminDetailTitle">FashionablyLate</h2>

        <div class="admin-modal__body">
            <div class="admin-modal__row">
                <div class="admin-modal__label">お名前</div>
                <div class="admin-modal__value" id="m_name"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">性別</div>
                <div class="admin-modal__value" id="m_gender"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">メールアドレス</div>
                <div class="admin-modal__value" id="m_email"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">電話番号</div>
                <div class="admin-modal__value" id="m_tel"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">住所</div>
                <div class="admin-modal__value" id="m_address"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">建物名</div>
                <div class="admin-modal__value" id="m_building"></div>
            </div>

            <div class="admin-modal__row">
                <div class="admin-modal__label">お問い合わせの種類</div>
                <div class="admin-modal__value" id="m_category"></div>
            </div>

            <div class="admin-modal__row admin-modal__row--detail">
                <div class="admin-modal__label">お問い合わせ内容</div>
                <div class="admin-modal__value admin-modal__value--detail" id="m_detail"></div>
            </div>

            {{-- 削除ボタン（仕様スクショにあるため） --}}
            <form method="POST" id="m_delete_form" class="admin-modal__actions" novalidate>
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-modal__delete">削除</button>
            </form>
        </div>
    </div>
</div>

@endsection