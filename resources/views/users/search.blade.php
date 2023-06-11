@php
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')

<div class="search-container">
  {!! Form::open(['class' => 'form','method' => 'GET']) !!}

  <div class="search-box">
    {{ Form::text('search',null,['class' => 'input form-control search-text','placeholder' => 'ユーザー名']) }}
    {{ Form::image('images/search.png', 'alt text', ['class' => 'index-form search-icon']) }}
  </div>

  {!! Form::close() !!}


  @if(isset($search))

  <p class="su-word" >検索ワード：{{$search}}</p>

  @endif

</div>

<p class="br"></p>


@foreach ($users as $user)
  <div class="su-container">

        <div class="su-box">
          <img class="su-icon" src="{{ $user->icon }}">
          <td>{{ $user->username }}</td>
        </div>


         @if(Follow::where([
          ['following_id','=',Auth::user()->id],
          ['followed_id','=',$user->id],
          ])->exists())
          <!-- フォローが自分でフォロワーが相手のデータがある時 -->

        <div class="su-follow">
          {!! Form::open(['url' => '/search/unfollow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::hidden('search', $search) }}
            {{ Form::submit('フォロー解除', ['class' => "btn btn-danger"]) }}
          {!! Form::close() !!}
        </div>

         @else
         <div class="su-follow">
          {!! Form::open(['url' => '/search/follow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::hidden('search', $search) }}
            {{ Form::submit('フォローする', ['class' => "btn btn-primary"]) }}
          {!! Form::close() !!}
         </div>

         @endif
   </div>
  @endforeach



@endsection



