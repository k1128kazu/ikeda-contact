<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInputRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせ入力画面
     */
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    /**
     * お問い合わせ確認画面
     */
    public function confirm(ContactInputRequest $request)
    {
        $data = $request->validated();

        // 電話番号を連結（ハイフンなし）
        $data['tel'] = $data['tel1'] . $data['tel2'] . $data['tel3'];

        // 性別表示用
        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        $data['gender_text'] = $genderMap[$data['gender']] ?? '';

        // カテゴリ名取得
        $category = Category::find($data['category_id']);
        $data['category_text'] = $category ? $category->content : '';

        return view('contact.confirm', compact('data'));
    }

    /**
     * 修正（入力画面に戻る）
     */
    public function back(Request $request)
    {
        return redirect()
            ->route('contact.index')
            ->withInput($request->all());
    }

    /**
     * DB保存 → サンクス画面
     */
    public function store(ContactInputRequest $request)
    {
        $data = $request->validated();

        // 電話番号を連結（ハイフンなし）
        $tel = $data['tel1'] . $data['tel2'] . $data['tel3'];

        Contact::create([
            'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'gender'      => $data['gender'],
            'email'       => $data['email'],
            'tel'         => $tel,
            'address'     => $data['address'],
            'building'    => $data['building'] ?? null,
            'category_id' => $data['category_id'],
            'detail'      => $data['detail'],
        ]);

        return redirect('/thanks');
    }
}
