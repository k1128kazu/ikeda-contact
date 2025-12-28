<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->buildFilteredQuery($request);

        $contacts = $query
            ->orderByDesc('created_at')
            ->paginate(7) // スクショの表示行に近づける（必要なら10に戻してOK）
            ->withQueryString();

        $categories = Category::all();

        return view('admin.contacts.index', compact('contacts', 'categories'));
    }

    public function show(Contact $contact)
    {
        $contact->load('category');
        return view('admin.contacts.show', compact('contact'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = $this->buildFilteredQuery($request)->orderByDesc('created_at');

        $fileName = 'contacts.csv';

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');

            // 文字化け対策（Excel想定：SJIS）
            fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM（環境により不要。必要ならSJIS変換に変更）

            fputcsv($out, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '登録日']);

            $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];

            $query->chunk(200, function ($rows) use ($out, $genderMap) {
                foreach ($rows as $c) {
                    $name = $c->last_name . ' ' . $c->first_name;
                    $gender = $genderMap[$c->gender] ?? '';
                    $category = optional($c->category)->content ?? '';
                    $date = $c->created_at ? $c->created_at->format('Y-m-d') : '';

                    fputcsv($out, [$name, $gender, $c->email, $category, $date]);
                }
            });

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('message', 'お問い合わせを削除しました');
    }

    private function buildFilteredQuery(Request $request)
    {
        $query = Contact::with('category');

        // ✅ スクショ：1つの入力欄「名前やメールアドレス」
        if ($request->filled('keyword')) {
            $kw = $request->keyword;
            $query->where(function ($q) use ($kw) {
                $q->where('last_name', 'like', "%{$kw}%")
                    ->orWhere('first_name', 'like', "%{$kw}%")
                    ->orWhere('email', 'like', "%{$kw}%");
            });
        }

        // ✅ 性別（プルダウン）
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // ✅ お問い合わせの種類（カテゴリ）
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // ✅ 年/月/日（単日指定）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        return $query;
    }
}
