<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    protected $fillable = ["comment_id", "user_id"];
}
