@extends('layouts.login')

@section('content')
<img src="{{Auth::user()->icon}}">
{!! Form::open(['url' => '/top', 'class' => 'form']) !!}

   {{ Form::text('post',null,['class' => 'input form-control ','placeholder' =>'投稿内容を入力してください']) }}

   {{ Form::hidden('user_id',Auth::user()->id) }}

   {{ Form::hidden('update_at',Auth::user()->update_at) }}

   {{ Form::image('images/post.png', 'alt text', ['class' => 'index-form']) }}

{!! Form::close() !!}

<table>
    @foreach ($posts->reverse() as $post)
    <tr>
        <td><img src="{{ $post -> user-> icon }}"></td>
        <td>{{ $post -> user-> username }}</td>
        <td>{{ $post -> post }}</td>
        <td>{{ $post -> created_at }}</td>

        @if (Auth::user()->id === $post->user_id)

          <td>
            <div class="content">
              <!-- モーダルを開く -->
              <a class="js-modal-open" href="" post="{{$post->post}}" post_id="{{$post->id}}">
                <img class="update" src="images/edit.png" alt="編集">
              </a>
            </div>
          </td>

          <td>
              <form action="/top/delete" method="POST" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？')">
                 @csrf
                 <input type="hidden" name="id" value="{{ $post->id }}">
                 <button type="submit"><img src="images/trash.png" alt="削除"></button>
              </form>
          </td>

        @endif
    </tr>
    @endforeach
</table>

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

