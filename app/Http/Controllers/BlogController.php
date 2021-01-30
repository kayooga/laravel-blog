<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * ①(M)Blog Modelを呼び出す
     * ②(C)ControllerからBladeに渡す
     * ③(V)Bladeで表示する
     * 
     * ブログ一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();

        return view('blog.list',['blogs' => $blogs]);
    }

    /**
     * ブログ詳細を表示する
     * @rapam int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        //idが取得できなかったら上のshowListを表示させる
        if (is_null($blog)) {
            //sessionを作ってメッセージを一覧画面に表示させる
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }

        return view('blog.detail',['blog' => $blog]);
    }
    /**
     * ブログ登録画面の表示
     * 
     * @return view
     */
    public function showCreate()
    {
        return view('blog.form');
    }
    /**
     * ブログを登録する
     * 
     * @return view
     */
    // Requestを使ってわたってきたデータを登録することができる
    public function exeStore(BlogRequest $request)
    {
        //ブログのデータを受け取る
        $inputs = $request->all();
        // dd($inputs);
        //トランザクション  データの処理では必ずいれる  エラーがなかったら登録する、あったら登録しない
        \DB::beginTransaction();
        try {
            //ブログを登録
            // Blog::create($inputs);
            \DB::commit($inputs);
        } catch(\Throwable $e) {
            // 本来はここでエラー内容のログを出力する
            \DB::rollback();
            //成功しなかったときは500エラーが表示される
            abort(500);
        }

        //ブログを登録
        Blog::create($inputs);
        \Session::flash('err_msg','ブログを登録しました');
        return redirect(route('blogs'));
    }
    /**
     * ブログ編集画面を表示する
     * @rapam int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);
        //idが取得できなかったら上のshowListを表示させる
        if (is_null($blog)) {
            //sessionを作ってメッセージを一覧画面に表示させる
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }

        return view('blog.edit',['blog' => $blog]);
    }
    /**
     * ブログを編集する
     * 
     * @return view
     */
    // Requestを使ってわたってきたデータを登録することができる
    public function exeUpdate(BlogRequest $request)
    {
        //ブログのデータを受け取る
        $inputs = $request->all();
        // dd($inputs);
        //トランザクション  データの処理では必ずいれる  エラーがなかったら登録する、あったら登録しない
        \DB::beginTransaction();
        try {
            //ブログを更新する
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],            
                'content' => $inputs['content']
                ]);
                $blog->save();
            \DB::commit();
        } catch(\Throwable $e) {
            echo $e;
            // 本来はここでエラー内容のログを出力する
            \DB::rollback();
            //成功しなかったときは500エラーが表示される
            abort(500);
        }

        \Session::flash('err_msg','ブログを更新しました');
        return redirect(route('blogs'));
    }
    /**
     * ブログ削除
     * @rapam int $id
     * @return view
     */
    public function exeDelete($id)
    {
        
        if (empty($id)) {
            //sessionを作ってメッセージを一覧画面に表示させる
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }

        try {
            //ブログを削除
            Blog::destroy($id);
        } catch(\Throwable $e) {
            echo $e;
            //成功しなかったときは500エラーが表示される
            abort(500);
        }

        //idが取得できなかったら上のshowListを表示させる
        \Session::flash('err_msg','削除しました');
        return redirect(route('blogs'));
    }
}
