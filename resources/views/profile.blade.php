@extends('layouts.app')

@section('content')

 @foreach($posts as $post)
            <div class="container card mt-2" style="width: 32rem;">
            <img src="{{ asset('images')."/".$post->img_url }}" class="card-img-top" alt="img not found">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->champion }} // {{$post["OwnerUser"]["username"]}} </h5>
                    <p>{{$post->description}}</p>
                    <p id="likes{{$post->id}}">{{$post["like"]->count()}}</p>
                    @csrf
                    @guest
                    <a href="{{ route('login') }}" class="alert-danger">რეგისტრაცია/Login to like!</a>
                    @else
                    <button class="btn btn-success" onclick="addLike({{$post->id}})">Like</button>
                    @endguest
                        
                    <form action="{{ route('showcomments', ["id"=> $post->id ]) }}" method="get">
                        <button class="btn btn-primary">კომენტარები</button>
                    </form>

                </div>
            </div>
        @endforeach

@endsection