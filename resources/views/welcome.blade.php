<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ავტო ბლოგი</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        {{-- <div class="flex-center position-ref full-height">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <ul>
                    <li><a href="/" title="LoL Fanart">ავტო ბლოგი</a></li>
                    
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <li><a href="{{ url('/home') }}">მთავარი</a></li>
                        @else
                            <li><a href="{{ route('login') }}">შესვლა</a></li>

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">რეგისტრაცია</a></li>
                            @endif
                        @endauth
                
            @endif
                
                </ul>
            </nav>
        </div> --}}


       
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
    <a class="navbar-brand" href="/">ავტო ბლოგი</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
        @if (Route::has('login'))
            @auth
                <li class="nav-item active my-2 my-lg-0">
                    <a class="nav-link" href="{{ url('/home') }}">ჩემი გვერდი</a>
                </li>
            @else
                <li class="nav-item active mr-sm-2"><a class="nav-link" href="{{ route('login') }}">შესვლა</a></li>

                @if (Route::has('register'))
                    <li class="nav-item active mr-sm-2"><a class="nav-link" href="{{ route('register') }}">რეგისტრაცია</a></li>
                @endif
            @endauth
        @endif
                <li class="nav-item active my-2 my-lg-0">
                    <form method="post" action="{{ route('searchChamp') }}" class="form-inline my-2 my-lg-0">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" placeholder="Search by champion" aria-label="Search" name="champion">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">ძებნა</button>
                    </form>
                </li>
                </ul>
        </div>
        </nav>

            <div class="content">
                <div class="title m-b-md">
                    
                </div>
            </div>
        </div>
        </div>

        @foreach($posts as $post)
            <div class="container card mt-2" style="width: 32rem;">
            <img src="{{ asset('images')."/".$post->img_url }}" class="card-img-top" alt="img not found">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->champion }}</h5>
                    <form action="{{ route('profile') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$post["OwnerUser"]["id"]}}">
                        <button> {{$post["OwnerUser"]["username"]}} </button>
                    </form>
                    <p>{{$post->description}}</p>
                    <p id="likes{{$post->id}}">{{$post["like"]->count()}}</p>
                    @csrf
                    @guest
                    <a href="{{ route('login') }}" class="alert-danger">Register/Login to like!</a>
                    @else
                    <button class="btn btn-success" onclick="addLike({{$post->id}})">Like</button>
                    @endguest
                        
                    <form action="{{ route('showcomments', ["id"=> $post->id ]) }}" method="get">
                        <button class="btn btn-primary">კომენტარები</button>
                    </form>

                </div>
            </div>
        @endforeach

    

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function addLike(id) {
                $.ajax({
                        method: "POST",
                        url: "{{ route('addlike') }}",                
                        data:{
                          id:id,
                          _token:$("input[name='_token']").val(),
                        },                            
                        success: function(data) {
                            if(data==1){
                                $("#likes"+id).html(parseInt($("#likes"+id).html()) + 1)
                            }
                        },                
                    });
                }
        </script>
    </body>
</html>
