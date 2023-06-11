@extends('layouts.login')

@section('content')


<div class="profile-container">

    <img class="profile-icon" src="{{Auth::user()->icon}}">

    {!! Form::open(['url' => '/profile', 'class' => 'form form-inline', 'enctype'=>"multipart/form-data"]) !!}
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach

    <div class="profile-big-box">

        <div class="profile-box">
            <p class="profile-label">username</p>
            {{ Form::text('username',Auth::user()->username,['class' => 'input form-control profile-form']) }}
        </div>

        <div class="profile-box">
            <p class="profile-label">mail address</p>
            {{ Form::email('mail',Auth::user()->mail,['class' => 'input form-control profile-form']) }}
        </div>

        <div class="profile-box">
            <p class="profile-label">password</p>
            {{ Form::password('password',['class' => 'input form-control profile-form profile-form']) }}
        </div>

        <div class="profile-box">
            <p class="profile-label">password confirm</p>
            {{ Form::password('password_confirmation',['class' => 'input form-control profile-form']) }}
        </div>

        <div class="profile-box">
            <p class="profile-label">bio</p>
            {{ Form::text('bio',Auth::user()->bio,['class' => 'input form-control profile-form']) }}
        </div>

        <div class="profile-box">
            <p class="profile-label">icon image</p>
            {{ Form::file('images',['class' => 'input form-control profile-form']) }}
        </div>


        <div class="profile-box">
            {{ Form::submit('更新', ['class' => 'btn btn-danger profile-button']) }}
        </div>

    </div>
    {!! Form::close() !!}
</div>

@endsection