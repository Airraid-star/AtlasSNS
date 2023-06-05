@php
use App\User;
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')




<div>
    <img src="{{ $user->icon }}">
    <p>name</p>
    <p>{{ $user->username }}</p>
    <p>bio</p>
    <p>{{ $user->bio }}</p>

    @if(Follow::where([
          ['following_id','=',Auth::user()->id],
          ['followed_id','=',$user->id],
          ])->exists())
          <!-- フォローが自分でフォロワーが相手のデータがある時 -->

         <td>
          {!! Form::open(['url' => '/user_profile/unfollow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::submit('フォロー解除', ['class' => "btn btn-danger"]) }}
          {!! Form::close() !!}
        </td>

         @else
        <td>
          {!! Form::open(['url' => '/user_profile/follow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::submit('フォローする', ['class' => "btn btn-primary"]) }}
          {!! Form::close() !!}
        </td>

    @endif
</div>



@foreach ($posts->reverse() as $post)
<div>
    <img src="{{ $post->user->icon }}">
    <h3>{{$post->user->username}}</h3>
    <p>{{$post->post}}</p>
    <p>{{$post->created_at}}</p>
</div>
@endforeach


@endsection