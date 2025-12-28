<?php

return [
    'required' => ':attribute は必須項目です。',
    'email' => ':attribute は正しいメールアドレス形式で入力してください。',

    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
    'custom' => [
        'last_name' => [
            'required' => '名字を入力してください。',
        ],
        'first_name' => [
            'required' => '名前を入力してください。',
        ],
        'gender' => [
            'required' => '性別を選択してください。',
        ],
        'email' => [
            'required' => 'メールアドレスを入力してください。',
            'email'    => 'メールアドレスの形式が正しくありません。',
        ],
        'address' => [
            'required' => '住所を入力してください。',
        ],
        'category_id' => [
            'required' => 'お問い合わせの種類を選択してください。',
        ],
        'detail' => [
            'required' => 'お問い合わせ内容を入力してください。',
            'max'      => 'お問い合わせ内容は :max 文字以内で入力してください。',
        ],
        'tel' => [
            'required' => '電話番号を入力してください。',
        ],
        'tel1' => [
            'regex' => '電話番号は 半角英数字で入力してください。',
        ],
        'tel2' => [
            'regex' => '電話番号は 半角英数字で入力してください。',
        ],
        'tel3' => [
            'regex' => '電話番号は 半角英数字で入力してください。',
        ],
        // ────────────────
        // Register 画面  ← ★ ここを今回追加
        // ────────────────
        'name' => [
            'required' => 'お名前を入力してください。',
            'string'   => 'お名前は文字列で入力してください。',
            'max'      => 'お名前は :max 文字以内で入力してください。',
        ],
        'password' => [
            'required' => 'パスワードを入力してください。',
            'min'      => 'パスワードは :min 文字以上で入力してください。',
            'confirmed' => '確認用パスワードが一致しません。',
        ],
        'password_confirmation' => [
            'required' => '確認用パスワードを入力してください。',
        ],
        // ログイン用メッセージ
        'login' => [
            'not_found' => 'ログイン情報が登録されていません。',
            'password_mismatch' => '確認用パスワードが一致しません。',
        ],
    
    ],

];
