<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@foreach($posts as $post)
	<h5>{{$post->description}}</h5>
	<h4>{{ $post->owner_user->username }}</h4>
	@endforeach
</body>
</html>