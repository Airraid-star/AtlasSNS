@extends('layouts.logout')

@section('content')

<div class="clear">
  <div class="clear-hello">
    <p>{{Session::get('username')}}さん</p>
    <p>ようこそ!AtlasSNSへ!</p>
  </div>

  <div class="clear-p">
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>
  </div>

<div class="center">
  <a href="/login" class="btn btn-danger">ログイン画面へ</a>
</div>

@endsection