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


{{ Form::label('username','user name') }}
{{ Form::text('username',null,['class' => 'input form-control']) }}

{{ Form::label('mail','mail adress') }}
{{ Form::text('mail',null,['class' => 'input form-control']) }}

{{ Form::label('password','pasword') }}
{{ Form::password('password',['class' => 'input form-control']) }}

{{ Form::label('password_confirmation','password comfirm') }}
{{ Form::password('password_confirmation',['class' => 'input form-control']) }}
<!-- [_confirmation]をつけることでconfirmationのタグで -->

<div class="right">
    {{ Form::submit('REGISTER', ['class' => 'btn btn-danger']) }}
</div>


<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
