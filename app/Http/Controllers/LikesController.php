<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Likes;
use Auth;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    
    public function addlike(Request $request)
    {
    	$Likes = Likes::where("post_id", $request->input('id'))->where("user_id", Auth::user()->id)->count();

    	if($Likes > 0) {
    		return 0;
    	}
    	Likes::create([
    		"post_id"=>$request->input("id"),
    		"user_id"=>Auth::user()->id
    	]);
    	return 1;
    }
}
