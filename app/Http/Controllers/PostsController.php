<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Follow;


class PostsController extends Controller
{

    //
    public function index(Request $request){

        $followedUsers = Follow::where('following_id',Auth::user()->id)->pluck('followed_id');
        //followsテーブルのpluckでフォロワーのIDのみ取得

        $posts = collect();
        //$postsと$usersを空の配列として定義

        if(Post::whereIn('user_id',$followedUsers)->exists()){
                $posts = Post::whereIn('user_id',$followedUsers)
                         ->orWhere('user_id',Auth::user()->id)->get();
            }



        if($request->isMethod('post')){
            $request->validate([
                'post'=>['required','min:1','max:150']
            ]);

            $post = $request->input('post');
            $user_id = $request->input('user_id');

            Post::create([
                'post' => $post,
                'user_id' => $user_id
            ]);

            return redirect('/top');
        }



        $relation = Post::find(1)->user()->latest()->get();


        return view('posts.index',compact('posts'));
    }




    public function delete(Request $request)
    {
        $id = $request->input('id');
        Post::where('id',$id)->delete();

        return redirect ('top');
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $post = Post::find($id);


        $post->post = $request->input('post');
        $post->save();

        return redirect ('top');
    }




    public function follow_list()
    {
        $followedUsers = Follow::where('following_id',Auth::user()->id)->pluck('followed_id');
        //followsテーブルのpluckでフォロワーのIDのみ取得

        $posts = collect();
        $users = collect();
        //$postsと$usersを空の配列として定義

        if(Post::whereIn('user_id',$followedUsers)->exists()){
                $posts = Post::whereIn('user_id',$followedUsers)->get();
            }

        if(User::whereIn('id',$followedUsers)->exists()){
                $users = User::whereIn('id',$followedUsers)->get();}//whereInは配列内のどれかをwhereで探す

        return view('follows.followList',compact('posts','users'));
    }



    public function follower_list()
    {
        $followedUsers = Follow::where('followed_id',Auth::user()->id)->pluck('following_id');
        //followsテーブルのpluckでフォロワーのIDのみ取得

        $posts = collect();
        $users = collect();
        //$postsと$usersを空の配列として定義

        if(Post::whereIn('user_id',$followedUsers)->exists()){
                $posts = Post::whereIn('user_id',$followedUsers)->get();}

        if(User::whereIn('id',$followedUsers)->exists()){
                $users = User::whereIn('id',$followedUsers)->get();
        }//whereInは配列内のどれかをwhereで探す

        return view('follows.followerList',compact('posts','users'));
    }



    public function user_profile(Request $request){
        if ($request->session()->has('id')) {

            $id =$request->session()->get('id');// セッションからidを取得し$idに代入
            $request->session()->forget('id'); // セッションからidを削除
        }else{
            $id = $request->input('user');
        }

        $posts = Post::where('user_id',$id)->get();

        $user = User::find($id);
        //find()メソッドは主キーを指定して単一のレコードを取得
        //get()メソッドだと複数のユーザーのレコードを含むコレクション）として返される
        //その為今回のように単一の場合は使用不可、firstやfindを使用しよう

        return view('follows.profile',compact('posts','user'));
    }
}
