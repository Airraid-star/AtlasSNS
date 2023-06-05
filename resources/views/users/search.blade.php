@php
use App\Follow;
@endphp

@extends('layouts.login')

@section('content')

{!! Form::open(['class' => 'form','method' => 'GET']) !!}


{{ Form::text('search',null,['class' => 'input form-control','placeholder' => 'ユーザー名']) }}


{{ Form::image('images/search.png', 'alt text', ['class' => 'index-form']) }}


{!! Form::close() !!}


@if(isset($search))
 <p>検索ワード：{{$search}}</p>
 @endif

<table>
    @foreach ($users as $user)
        <tr>
         <td><image src="{{ $user->icon }}"></td>

         <td>{{ $user->username }}</td>


         @if(Follow::where([
          ['following_id','=',Auth::user()->id],
          ['followed_id','=',$user->id],
          ])->exists())
          <!-- フォローが自分でフォロワーが相手のデータがある時 -->

        <td>
          {!! Form::open(['url' => '/search/unfollow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::hidden('search', $search) }}
            {{ Form::submit('フォロー解除', ['class' => "btn btn-danger"]) }}
          {!! Form::close() !!}
        </td>

         @else
        <td>
          {!! Form::open(['url' => '/search/follow', 'class' => 'form']) !!}
            {{ Form::hidden('id', $user->id) }}
            {{ Form::hidden('search', $search) }}
            {{ Form::submit('フォローする', ['class' => "btn btn-primary"]) }}
          {!! Form::close() !!}
        </td>

         @endif
        <tr>
    @endforeach
</table>


@endsection



