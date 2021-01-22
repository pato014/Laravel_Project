<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Auth;
use App\Posts;
class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    
    public function storePosts(Request $request)
    {
    	if(Input::file("image")){
    		$dp=public_path('images');
    		$filename=uniqid().".jpg";
    		$img=Input::file("image")->move($dp, $filename);
    	}

    	Posts::create([
    		'User_id'=>Auth::user()->id,
    		'description'=>$request->input("description"),
    		'champion'=>$request->input("champion"),
    		'img_url'=>$filename
    	]);

        return redirect()->route('firstpage');
    }

    public function edit($id)
    {
        $post=Posts::where("id", $id)->firstorfail();
        return view("edit", ["posts"=>$post]);
    }

    public function update(Request $request)
    {
        Posts::where("id", $request->input("id"))->update([
            "description"=>$request->input("description"),
            "champion"=>$request->input("champion")
        ]);

        return redirect()->route('firstpage');
    }

    public function delete(Request $request)
    {
        Posts::where("id", $request->input("id"))->delete();
        return redirect()->back();
    }

}
