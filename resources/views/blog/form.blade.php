@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <h2>ブログ投稿フォーム</h2> 
          {{-- onSubmit  JSの表示 --}}
          <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
            {{-- csrf対策 書くだけ --}}
            @csrf
              <div class="form-group">
                  <label for="title">
                      タイトル
                  </label>
                  <input
                      id="title"
                      name="title"
                      class="form-control"
                      value="{{ old('title') }}"
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
                  >{{ old('content') }}</textarea>
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
                      投稿する
                  </button>
              </div>
          </form>
      </div>
  </div>
  <script>
    function checkSubmit(){
      if(window.confirm('送信してよろしいですか？')){
          return true;
      } else {
          return false;
      }
    }
  </script>
@endsection