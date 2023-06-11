<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Follow;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    //
    public function profile(Request $request){
        if($request->isMethod('post')){

            $request->validate([
                'username'=>['required','min:2','max:12'],
                'mail'=>['required','min:5','max:40','email',Rule::unique('users')->ignore(Auth::user()->id,'id')],
                'password'=>['required','digits_between:8,20','confirmed'],
                'bio'=>['max:150'],
                'images'=>['mimes:jpg,png,bmp,gif,svg']
            ]);

            //[_confirmed]とついた物にバリテーションで[confirmed]をつけると確認入力となる
            //'digits_between:8,20'は８桁から２０桁までの数字の意味

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');
            $bio = $request->input('bio');
            $images = $request->file('images');

            $user = Auth::user();
            $user->username = $username;
            $user->mail = $mail;
            $user->bio = $bio;

            if (is_null($password)) {
                $user->password = Auth::user()->password;
            }else{
                $user->password = bcrypt($password);
            }

            if (is_null($images)) {
                $user->images = Auth::user()->images;
            }else{
                $file_name = $request->file('images')->getClientOriginalName();
                $request->file('images')->storeAs('public',$file_name); // 例: public/images/フォルダに保存される
                $user->images = $file_name;
            }


            $user->save();

            return redirect('/top');
        }
        return view('users.profile');}





    public function search(Request $request){
        if ($request->session()->has('search')) {

            $search = $request->input('search');
            // セッションからsearchを取得し$searchに代入
            $request->session()->forget('search');
            // セッションからidを削除

        }else{
        $search = $request->input('search');
        }


        $query = User::query()->where('id','!=', Auth::user()->id);
        //自分以外のクエリを取得

        if($search){
            $query->where('username','like','%'.$search.'%');
        }

        $users = $query->get();

        return view('users.search',[
            'users' => $users,
            'search' =>$search
        ]);
    }




    public function follow(Request $request){


        Follow::firstOrCreate([
            'following_id' => Auth::user()->id,
            'followed_id' => $request->id
        ]);
        //followテーブルにデータ作成


        $url = $request->url();
        // 現在のURLを取得



        if(strpos($url,'/user_profile')){

            $id = $request->input('id');

            $request->session()->flash('id', $id);
            // セッションにidを一時的に保存

            return redirect()->route('user_profile',compact('id'));


        }elseif(strpos($url,'/search')){

            $search = $request->input('search');

            $request->session()->flash('search', $search);

            return redirect()->route('search',compact('search'));
        }

    }


    public function unfollow(Request $request){


        $follow = Follow::where([
            ['following_id','=',Auth::user()->id],
            ['followed_id','=',$request->id],
            ])
        ->first();
        $follow->delete();
         //followテーブルからデータを探し、それを削除


        $url = $request->url();
        // 現在のURLを取得


        if(strpos($url,'/user_profile')){

            $id = $request->input('id');

            $request->session()->flash('id', $id);
            // セッションにidを一時的に保存

            return redirect()->route('user_profile',compact('id'));


        }elseif(strpos($url,'/search')){

            $search = $request->input('search');

            $request->session()->flash('search', $search);

            return redirect()->route('search',compact('search'));
        }

    }




}
