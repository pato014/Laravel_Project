@extends('layouts.app')

@section('content')

 @foreach($results as $result)
            <div class="container card mt-2" style="width: 32rem;">
            <img src="{{ asset('images')."/".$result->img_url }}" class="card-img-top" alt="img not found">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->champion }} // {{$result["OwnerUser"]["username"]}} </h5>
                    <p>{{$result->description}}</p>
                    <p id="likes{{$result->id}}">{{$result["like"]->count()}}</p>
                    @csrf
                    @guest
                    <a href="{{ route('login') }}" class="alert-danger">Register/Login to like!</a>
                    @else
                    <button class="btn btn-success" onclick="addLike({{$result->id}})">Like</button>
                    @endguest
                        
                    <form action="{{ route('showcomments', ["id"=> $result->id ]) }}" method="get">
                        <button class="btn btn-primary">კომენტარები</button>
                    </form>

                </div>
            </div>
        @endforeach

@endsection