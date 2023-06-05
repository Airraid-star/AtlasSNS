@php
use App\User;
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')

<h2>Follow list</h2>
@if($users -> isNotEmpty() )
@foreach ($users->reverse() as $user)
    <div>
        <img src="{{ $user->icon }}">
        <p>{{ $user->username }}</p>
    </div>
@endforeach
@endif

@if($posts -> isNotEmpty() )
@foreach ($posts->reverse() as $post)
    <div>
        {!! Form::open(['url' => '/user_profile']) !!}
        {{ Form::image($post->user->icon, 'alt text') }}
        {{ Form::hidden('user',$post->user->id ) }}
        {!! Form::close() !!}
        <!-- 押すとプロフィールが表示されるアイコン -->
        <h3>{{$post->user->username}}</h3>
        <p>{{$post->post}}</p>
        <p>{{$post->created_at}}</p>
    </div>
@endforeach
@endif

@endsection