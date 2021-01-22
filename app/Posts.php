<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable=["User_id", "description", "img_url", "champion"];

    public function OwnerUser(){
		return $this->hasOne('App\User', 'id', 'User_id');
	}
	public function like(){
		return $this->hasMany('App\Likes', 'post_id');
	}

	public function comments(){
		return $this->hasMany('App\Comments', 'post_id');
	}

}
