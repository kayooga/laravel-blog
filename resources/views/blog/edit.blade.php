@extends('layout')
@section('title', 'ブログ編集')
@section('content')
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <h2>ブログ編集フォーム</h2> 
          {{-- onSubmit  JSの表示 --}}
          <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
            {{-- csrf対策 書くだけ --}}
            @csrf
            <input type="hidden" name="id" value="{{ $blog->id }}">
              <div class="form-group">
                  <label for="title">
                      タイトル
                  </label>
                  <input
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ $blog->title }}"
                        type="text"
                  >
                  {{-- バリデーションを受け取る処理 --}}
                  {{-- 最初に引っかかったエラー処理のメッセージを表示させる(first) --}}
                  @if ($errors->has('title'))
                      <div class="text-danger">
                          {{ $errors->first('title') }}
                      </div>
                  @endif
              </div>
              <div class="form-group">
                  <label for="content">
                      本文
                  </label>
                  <textarea
                      id="content"
                      name="content"
                      class="form-control"
                      rows="4"
                  >{{ $blog->content }}</textarea>
                  @if ($errors->has('content'))
                      <div class="text-danger">
                          {{ $errors->first('content') }}
                      </div>
                  @endif
              </div>
              <div class="mt-5">
                  <a class="btn btn-secondary" href="{{ route('blogs') }}">
                      キャンセル
                  </a>
                  <button type="submit" class="btn btn-primary">
                      更新する
                  </button>
              </div>
          </form>
      </div>
  </div>
  <script>
    function checkSubmit(){
      if(window.confirm('更新してもよろしいですか？')){
          return true;
      } else {
          return false;
      }
    }
  </script>
@endsection