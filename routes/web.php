<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * ①ルーティング作成(登録画面表示・ブログ登録)
 * ②コントローラー作成(登録画面表示)
 * ③登録画面のBladeを表示(CSRF対策)
 * ④コントローラー作成(ブログ登録)
 * ⑤バリデーション作成
 * ⑥エラー処理
 */

//ブログ一覧画面を表示
Route::get('/', [BlogController::class,'showList'])->name('blogs');

//ブログ登録画面を表示
Route::get('/blog/create', [BlogController::class,'showCreate'])->name('create');

//ブログ登録
Route::post('/blog/store', [BlogController::class,'exeStore'])->name('store');

//ブログ詳細画面を表示
Route::get('/blog/{id}',[BlogController::class,'showDetail'])->name('show');

//ブログ編集画面を表示
Route::get('/blog/edit/{id}',[BlogController::class,'showEdit'])->name('edit');
Route::post('/blog/update',[BlogController::class,'exeUpdate'])->name('update');

//ブログ削除
Route::post('/blog/delete/{id}',[BlogController::class,'exeDelete'])->name('delete');