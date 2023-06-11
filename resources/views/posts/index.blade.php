@extends('layouts.login')

@section('content')

@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach

<div class="form-container">

  <div class="form-icon">
    <img src="{{Auth::user()->icon}}">
  </div>

  <div class="form-box">
  {!! Form::open(['url' => '/top']) !!}

   {{ Form::textarea('post',null,['class' => 'form-text','placeholder' =>'投稿内容を入力してください','rows'=>'4','cols'=>'50']) }}

   {{ Form::hidden('user_id',Auth::user()->id) }}

   {{ Form::hidden('update_at',Auth::user()->update_at) }}

   {{ Form::image('images/post.png', 'alt text', ['class' => 'form-post']) }}

   {!! Form::close() !!}
  </div>
</div>


<div id="post">

    @foreach ($posts->reverse() as $post)
    <div class="post-container">
        <p class="post-icon"><img src="{{ $post -> user-> icon }}"></p>
        <div class="post-box1">
          <p class="post-username">{{ $post -> user -> username }}</p>
          <p class="post-post">{{ $post -> post }}</p>
        </div>

      <div class="post-box2">

        <p class="post-create">{{ $post -> created_at }}</p>


        @if (Auth::user()->id === $post->user_id)

          <div class="post-ud">

            <div class="edit">
              <!-- モーダルを開く -->
              <a class="js-modal-open" href="" post="{{$post->post}}" post_id="{{$post->id}}">
                <img class="update" src="images/edit.png" alt="編集">
              </a>
            </div>

            <form action="/top/delete" method="POST" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？')">
              @csrf
              <input type="hidden" name="id" value="{{ $post->id }}">
              <button type="submit" class="delete-button">
                <div class="delete-icon"></div>
              </button>
            </form>

          </div>
        @endif


      </div>

    </div>
    @endforeach

</div>

<!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
     <form action="/top/update" method="POST" alt="編集">
        <textarea name="post" class="modal_post" rows='8' cols='90' ></textarea>
        <input type="hidden" name="id" class="modal_id">
        <button type="submit"><img src="images/edit.png" alt="更新"></button>
        {{ csrf_field() }}
     </form>
  </div>
</div>


@endsection

