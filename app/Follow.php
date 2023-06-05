<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['following_id', 'followed_id'];



    public function user()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

}
