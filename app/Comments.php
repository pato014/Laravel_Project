<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Comments extends Model
{
    protected $fillable=["user_id", "post_id", "comment"];

    public function OwnerUser(){
		return $this->hasOne('App\User', 'id', 'user_id');
	}

    public function like(){
    	return $this->hasMany('App\CommentLikes', 'comment_id');
    }
}
