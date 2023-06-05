@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/profile', 'class' => 'form', 'enctype'=>"multipart/form-data"]) !!}

@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach


{{ Form::label('username') }}
{{ Form::text('username',Auth::user()->username,['class' => 'input form-control']) }}

{{ Form::label('mail address') }}
{{ Form::email('mail',Auth::user()->mail,['class' => 'input form-control']) }}

{{ Form::label('password') }}
{{ Form::password('password',null,['class' => 'input form-control']) }}

{{ Form::label('password_confirm') }}
{{ Form::password('password_confirmation',null,['class' => 'input form-control']) }}

{{ Form::label('bio') }}
{{ Form::text('bio',Auth::user()->bio,['class' => 'input form-control']) }}

{{ Form::label('icon image') }}
{{ Form::file('images',['class' => 'input form-control']) }}

{{ Form::submit('更新', ['class' => 'btn btn-danger']) }}

{!! Form::close() !!}

@endsection