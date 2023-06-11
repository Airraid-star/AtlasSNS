@php
use App\User;
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')

<div class="fl-container">
    <div class=fl-text>
        <h3>Follower list</h3>
    </div>

    @if($users -> isNotEmpty() )
        <div class="fl-icon">
           @foreach ($users->reverse() as $user)
              <img src="{{ $user->icon }}">
            @endforeach
        </div>
    @endif
</div>

@if($posts -> isNotEmpty() )
@foreach ($posts->reverse() as $post)
    <div class="post-container">
        {!! Form::open(['url' => '/user_profile']) !!}
        {{ Form::image($post->user->icon, 'alt text') }}
        {{ Form::hidden('user',$post->user->id ) }}
        {!! Form::close() !!}
        <!-- 押すとプロフィールが表示されるアイコン -->
        <div class="post-box1">
        <p class="post-username">{{$post->user->username}}</p>
        <p  class="post-post">{{$post->post}}</p>
        </div>
        <div class="post-box2">
        <p class="post-create">{{$post->created_at}}</p>
        </div>
    </div>
@endforeach
@endif

@endsection