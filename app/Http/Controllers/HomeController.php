<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Auth;
use App\User;
use App\Comments;
use App\CommentLikes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }


    public function testpage()
    {
        return Posts::with(['OwnerUser','like'])->orderBy('created_at', 'desc')->get();   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Posts::where('User_id', Auth::user()->id)->get();
        return view('home', ["posts"=>$post]);
    }

    public function showcomments($id)
    {
        $comments = comments::with(['OwnerUser', 'like'])->where('post_id', $id)->get();
        $post = Posts::where('id', $id)->firstOrFail();
        return view('comments', ["comments"=>$comments, "post"=>$post]);

        return $comments;
    }

    public function storeComment(Request $request)
    {
        Comments::create([
            "user_id"=>Auth::user()->id,
            "post_id"=>$request->input('post_id'),
            "comment"=>$request->input('comment')
        ]);

        return redirect()->back();
    }

    public function storeLikes(Request $request){
        $Likes = CommentLikes::where("comment_id", $request->input('id'))->where("user_id", Auth::user()->id)->count();

        if($Likes > 0) {
            return 0;
        }
        CommentLikes::create([
            "comment_id"=>$request->input("id"),
            "user_id"=>Auth::user()->id
        ]);
        return 1;
    }
}
