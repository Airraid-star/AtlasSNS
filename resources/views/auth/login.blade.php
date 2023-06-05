@extends('layouts.logout')

@section('content')

    {!! Form::open(['url' => '/login', 'class' => 'form']) !!}

    <p class="head-text">AtlasSNSへようこそ</p>

    {{ Form::label('e-mail') }}
    {{ Form::text('mail', null, ['class' => 'form-control ']) }}
    {{ Form::label('password') }}
    {{ Form::password('password', ['class' => 'form-control']) }}

    {{ Form::submit('LOGIN', ['class' => 'btn btn-danger']) }}

    <p><a href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
@endsection
