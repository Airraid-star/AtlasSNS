<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'post'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //HasManyが多の主、Belong（〜に属するの意）Toが一の従である一対多。
    //user（一）の従（多）と認定（一人のユーザーに複数の投稿のため）
}

