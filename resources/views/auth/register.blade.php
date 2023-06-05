@extends('layouts.logout')

<link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
<link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }} ">

@section('content')


<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register', 'class' => 'form']) !!}

<p class="head-text">新規ユーザー登録</p>

@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach


{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input form-control']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input form-control']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input form-control']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',null,['class' => 'input form-control']) }}
<!-- [_confirmation]をつけることでconfirmationのタグで -->
{{ Form::submit('REGISTER', ['class' => 'btn btn-danger']) }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
