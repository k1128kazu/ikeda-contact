<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminContactController;

/*
|--------------------------------------------------------------------------
| 一般ユーザー（ログイン不要）
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // トップはお問い合わせフォームへ
    return redirect()->route('contact.index');
});

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/confirm', [ContactController::class, 'confirm'])
    ->name('contact.confirm');

Route::post('/back', [ContactController::class, 'back'])
    ->name('contact.back');

Route::post('/thanks', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/thanks', function () {
    return view('contact.thanks');
})->name('contact.thanks');


/*
|--------------------------------------------------------------------------
| 管理者（ログイン必須）
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('admin.contacts.index');

    Route::get('/contacts/export', [AdminContactController::class, 'export'])
        ->name('admin.contacts.export');

    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])
        ->name('admin.contacts.show');
    // ★ 追加（削除）
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])
        ->name('admin.contacts.destroy');
});
