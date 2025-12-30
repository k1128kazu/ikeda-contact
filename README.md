# ikeda-contact（Laravel 8 + Fortify）

お問い合わせフォーム（一般ユーザー）＋ 管理画面（管理者）の  
2系統で構成された問い合わせ管理システムです。

- FW：Laravel 8
- PHP：8.1
- 認証：Laravel Fortify
- DB：MySQL
- Web：nginx / php-fpm
- IDE：VS Code
- コンテナ：Docker + docker-compose

---

## 1. プロジェクト構成

| 区分 | 内容 |
|-----|-----|
| 一般ユーザー | `/contact` からお問い合わせ送信（ログイン不要） |
| 入力フロー | 入力 → 確認 → 送信 → Thanks |
| 管理画面 | `/admin/contacts`（要ログイン） |
| 認証方式 | Fortify（メール＋パスワード） |
| データ登録 | contacts / categories |
| CSV出力 | SJIS形式（Excel互換） |

---

## 2. ER 図

ER 図は本リポジトリ直下に配置しています。

./ER.svg

yaml
コードをコピーする

---

## 3. テーブル仕様

### contacts

| カラム | 型 | 備考 |
|------|----|----|
| id | bigint | PK |
| last_name | string | 姓 |
| first_name | string | 名 |
| gender | tinyint | 1=男性 / 2=女性 / 3=その他 |
| email | string | |
| tel | string | ハイフン無し連結 |
| address | string | |
| building | string | nullable |
| category_id | bigint | FK(categories.id) |
| detail | text | |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 4. ルーティング仕様

### 一般ユーザー（ログイン不要）

/contact
/confirm
/back
/thanks

shell
コードをコピーする

### 管理者（要ログイン）

/admin/contacts

コードをコピーする

ログイン後遷移先：

/admin/contacts

yaml
コードをコピーする

---

## 5. 環境構築手順

本 README の手順で  
**環境構築 ～ マイグレーション ～ Seeder 実行まで完了します**

### ① Docker 起動

```bash
docker-compose up -d
② Composer install
bash
コードをコピーする
docker-compose exec php composer install
③ .env 作成
bash
コードをコピーする
cp .env.example .env
The stream or file "/var/www/storage/logs/laravel.log" could not be opened
という権限エラーが起きた場合は下記コマンドを実行してください
chmod -R 777 storage

DB設定（Docker MySQL）

ini
docker-compose exec php cp .env.example .env
.envファイルのDB設定は下記のように記述してください
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

※ DB 接続情報は docker-compose.yml と同一
④ アプリキー生成
bash
コードをコピーする
docker-compose exec php php artisan key:generate
⑤ マイグレーション実行
bash
コードをコピーする
docker-compose exec php php artisan migrate
6. ダミーデータ（Seeder / Factory 設計）
▶ 外部キー整合性を保証するため
Seeder 実行順を 必ず以下としています：

コードをコピーする
1) CategorySeeder（カテゴリマスタ作成）
2) ContactSeeder（お問い合わせデータ作成）
DatabaseSeeder
nginx
コードをコピーする
CategorySeeder → ContactSeeder の順に呼び出し
ContactFactory の仕様
固定ID（16〜20）は使用しない

categories.id を DB から動的取得

実在するIDのみ紐づける

ini
コードをコピーする
category_id = Category::inRandomOrder()->value('id')
created_at
コードをコピーする
過去30日以内でランダム生成
7. Seeder 実行手順（検証済）
bash
コードをコピーする
docker-compose exec php php artisan migrate:fresh --seed
期待される結果

項目	判定
categories → 先に作成	✅
contacts → 後に作成	✅
category_id = 実在ID	✅
外部キー制約エラーなし	✅
created_at = 過去30日内	✅

8. バリデーション設計（FormRequest運用）
入力チェック

swift
コードをコピーする
app/Http/Requests/ContactInputRequest.php
メッセージ文言

bash
コードをコピーする
resources/lang/ja/validation.php
電話番号

3分割入力

半角数字チェック

サーバーバリデーションのみ（novalidate）

9. 認証（Fortify）
ログイン後遷移：

bash
コードをコピーする
/admin/contacts
エラーメッセージ出し分け

ケース	表示位置	文言
未登録メール	メール欄下	ログイン情報が登録されていません
PW不一致	パスワード欄下	確認用パスワードが一致しません
入力不足	各欄下	validation.php に準拠

10. 管理画面機能
お問い合わせ一覧

検索（横並び1行・仕様準拠）

ページネーション1行表示

CSVエクスポート（SJIS）

検索条件

項目	内容
キーワード	名前 / メール
性別	プルダウン
種類	category_id
日付	単日
リセット	条件クリア

11. UI 仕様
Contact
入力 → 確認 → 送信

form は novalidate

ブラウザ検証を使用せず

全てサーバー側バリデーション

管理画面
詳細表示はモーダル

削除ボタンあり

hover 行強調

12. 419 セッションタイムアウト
英語エラーページは使用しない

仕様準拠の 419 専用ビューを表示

contact / admin でテンプレート切替

13. 運用ルール
バリデーションルール → FormRequest

メッセージ文言 → validation.php

認証制御 → Fortify

Seeder は カテゴリ → お問い合わせの順で実行

Factory で外部キー固定値は使用しない