@extends('layouts.app')

@section('content')
	<div class="container">
			<div class="container card mt-2" style="width: 32rem;">
				<img src="{{ asset('images')."/".$post["img_url"] }}" class="card-img-top" alt="">
				<p>{{$post->description}}</p>
		@foreach($comments as $comment)
				<div class="card">
					<div class="card-body">
					  	<h5>{{ $comment["OwnerUser"]["username"] }}</h5>
						<p>{{$comment->comment}}</p>
						<div class="d-flex">
							<div>
								<p>comment likes: </p>
							</div>
							<div id="likes{{$comment->id}}">
								{{$comment["like"]->count()}}
							</div> 
						</div> 
						<button class="btn btn-success" onclick="addLike({{$comment->id}})">Like</button>
					</div>
				</div>
		@endforeach
				<form action="{{ route('storeComments') }}" method="post">
					@csrf
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<input class="form-control"type="text" name="comment">
					<button type="submit" class="btn btn-primary">კომენტარის დამატება</button>
				</form>

			</div>	
	</div>

	<script type="text/javascript">
            function addLike(id) {
                $.ajax({
                        method: "POST",
                        url: "{{ route('storelikes') }}",                
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
@endsection