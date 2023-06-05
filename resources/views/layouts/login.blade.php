@php
use App\Post;
use App\User;
use App\Follow;
@endphp


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">

    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- JS、Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <header>
        <div id = "head">
            <p class="atlas"><a href="/top"><img src="images/atlas.png"></a></p>
            <p class="header-name"><a data-toggle="collapse" href="#functionList" role="button" aria-expanded="false" aria-controls="functionList">
                {{Auth::user()->username}}さん<img src="{{Auth::user()->icon}}">
            </a></p>

            <div class="collapse" id="functionList">
                <div class="card">
                    <div class="card-body">
                         <ul>
                             <li><a href="/top">ホーム</a></li>
                             <li><a href="/profile">プロフィール編集</a></li>
                             <li><a href="/logout">ログアウト</a></li>
                         </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{Auth::user()->username}}さんの</p>
                <div>
                <p>フォロー数　{{ Follow::where('following_id', Auth::user()->id)->count() }}人</p>
                </div>
                <p class="btn btn-primary"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <p>フォロワー数　{{ Follow::where('followed_id', Auth::user()->id)->count() }}人</p>
                </div>
                <p class="btn btn-primary"><a href="follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn btn-primary"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>


</body>
</html>
