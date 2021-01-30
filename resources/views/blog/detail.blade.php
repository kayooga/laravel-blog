<!-- 
  ブログの記事を表示
  -->

@extends('layout')
@section('title','ブログ詳細')
@section('content')
{{-- 
  ①リンクを作る
  ②routeを作る
  ③(CM) Controllerを作る
  ④(V) 詳細画面を作る --}}
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>{{ $blog->title }}</h2>
        <span>作成日{{ $blog->created_at }}</span>
        <span>更新日{{ $blog->updated_at }}</span>
        <p>{{ $blog->content }}</p>
    </div>
  </div>
@endsection
