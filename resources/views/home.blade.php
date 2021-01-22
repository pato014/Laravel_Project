@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <div>
        <form action="{{ route('storePosts') }}" method="POST" class="form-group mt-2" enctype="multipart/form-data">
            @csrf
            <input type="text" name="description" class="form-control mt-2">      
            <input type="text" name="champion" class="form-control mt-2">
            <input type="file" name="image" class="form-control mt-2">

            <button type="submit" class="btn btn-primary mt-2">add post</button>        
        </form>
    </div>
    @foreach($posts as $post)
    <div class="container card mt-2" style="width: 32rem;">
      <img src="{{ asset('images')."/".$post->img_url }}" class="card-img-top" alt="img not found">
      <div class="card-body">
        <h5 class="card-title">{{ $post->champion }} </h5>
        <h1 class="card-title">{{ $post->username }}</h1>
        <p class="card-text">{{ $post->description }}</p>
        <a href="{{ route('edit', ["id"=>$post->id]) }}" class="btn btn-info">
            განახლება
        </a>
        <form action="{{ route('adminDelete') }}" method="POST"> 
            @csrf
                <input type="hidden" name="id" value={{ $post->id }} >
                <button class="btn btn-danger">
                    წაშლა
                </button>
        </form>
      </div>
    </div>
    @endforeach
</div>
@endsection
