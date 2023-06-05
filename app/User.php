<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function user()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }



    public function follows(){
        return $this->belongsToMany(User::class,'follows','followed_id','following_id');
    }
    //belongsToMany('対象モデル','中間テーブル名','中間テーブル内で対応するID名（従）',<='対象モデルで対応するID名(主)')

    public function followers(){
        return $this->belongsToMany(User::class,'follows','following_id','followed_id');
    }


    public function getIconAttribute(){
    $imagePath = public_path('images/' . $this->images);

    if (file_exists($imagePath)) {
        return asset('images/' . $this->images);
    } else {
        return asset('storage/' . $this->images);
    }}


}