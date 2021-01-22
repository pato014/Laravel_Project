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
<div class="form-control">
    <form action="{{ route('updatepost') }}" method="POST" class="form-group" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control mt-2" name="id" value="{{$posts->id}}">
        <input type="text" name="description" class="form-control mt-2" value="{{ $posts->description }}">      
        <input type="text" name="champion" class="form-control mt-2" value="{{ $posts->champion }}">
        <button type="submit" class="btn btn-primary mt-2">პოსტის რედაქტირება</button>        
    </form>
</div>

@endsection