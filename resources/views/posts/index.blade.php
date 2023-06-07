@extends('layouts.login')

@section('content')
<div class="index-form">
  <img src="{{Auth::user()->icon}}">
  {!! Form::open(['url' => '/top']) !!}

   {{ Form::textarea('post',null,['class' => 'index-text','placeholder' =>'投稿内容を入力してください','rows'=>'4','cols'=>'40']) }}

   {{ Form::hidden('user_id',Auth::user()->id) }}

   {{ Form::hidden('update_at',Auth::user()->update_at) }}

   {{ Form::image('images/post.png', 'alt text', ['class' => 'form-post']) }}

   {!! Form::close() !!}
</div>


<div id="post">
    @foreach ($posts->reverse() as $post)
    <div class="post-container">
        <p class="post-icon"><img src="{{ $post -> user-> icon }}"></p>
        <p class="post-username">{{ $post -> user-> username }}</p>
        <p class="post-post">{{ $post -> post }}</p>
        <p class="post-create">{{ $post -> created_at }}</p>

        @if (Auth::user()->id === $post->user_id)
          <div class="post-ud">
            <div class="content">
              <!-- モーダルを開く -->
              <a class="js-modal-open" href="" post="{{$post->post}}" post_id="{{$post->id}}">
                <img class="update" src="images/edit.png" alt="編集">
              </a>
            </div>

            <form action="/top/delete" method="POST" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？')">
              @csrf
              <input type="hidden" name="id" value="{{ $post->id }}">
              <button type="submit">
                <img src="images/trash.png" alt="削除"></button>
            </form>
          </div>

        @endif
    </div>
    @endforeach
</div>

<!-- モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
     <form action="/top/update" method="POST" alt="編集">
        <textarea name="post" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id">
        <button type="submit"><img src="images/edit.png" alt="更新"></button>
        {{ csrf_field() }}
     </form>
     <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>


@endsection

