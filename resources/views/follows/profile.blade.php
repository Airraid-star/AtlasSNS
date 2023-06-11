@php
use App\User;
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')


<div class="fp-container">

    <img class="fp-icon" src="{{ $user->icon }}">
    <div class="fp-box1">
      <p>name</p>
      <p>bio</p>
    </div>

    <div class="fp-box2">
      <p>{{ $user->username }}</p>
      <p>{{ $user->bio }}</p>
    </div>


    @if(Follow::where([
          ['following_id','=',Auth::user()->id],
          ['followed_id','=',$user->id],
          ])->exists())
          <!-- フォローが自分でフォロワーが相手のデータがある時 -->

         <div class="fp-follow">
          {!! Form::open(['url' => '/user_profile/unfollow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::submit('フォロー解除', ['class' => "btn btn-danger"]) }}
          {!! Form::close() !!}
        </div>

         @else
        <div class="fp-follow">
          {!! Form::open(['url' => '/user_profile/follow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::submit('フォローする', ['class' => "btn btn-primary"]) }}
          {!! Form::close() !!}
        </div>
    @endif
  </div>



@foreach ($posts->reverse() as $post)

<div class="post-container">
    <img class="post-icon" src="{{ $post->user->icon }}">
    <div class="post-box1">
      <p class="post-text">{{$post->user->username}}</p>
      <p>{{$post->post}}</p>
    </div>
        <div class="post-box2">
    <p class="post-create">{{$post->created_at}}</p>
  </div>
</div>
@endforeach


@endsection