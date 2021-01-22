<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Auth;
class GuestController extends Controller
{
    public function firstpage()
    {
        $posts = Posts::with(['OwnerUser','like'])->orderBy('created_at', 'desc')->get();
        return view('welcome', ["posts"=>$posts]);
    }

    public function search(Request $request){
    	$result = Posts::with(['OwnerUser', 'like'])->where('champion', $request->input('champion'))->get();

    	return view('search', ["results"=>$result]);
    }

    public function profile(Request $request){
    	$posts = Posts::with(['OwnerUser', 'like'])->where('user_id', $request->input('id'))->get();

    	if(Auth::guest() || Auth::user()->id != $request->input('id')){
    		return view('profile', ["posts"=>$posts]);
    	}
    	else{
    		return redirect()->route('home');
    	}
    }
}
