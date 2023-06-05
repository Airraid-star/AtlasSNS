@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="clear-text">
    <p>{{Session::get('username')}}さん</p>
    <p>ようこそ!AtlasSNSへ!</p>
  </div>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn btn-danger"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection