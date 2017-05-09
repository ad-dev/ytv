<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Youtube videos</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">

<!-- Scripts -->
<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

        window.yt_item = '{{$yt_item}}';
    </script>

<!-- Styles -->
<style>
html, body {
	background-color: #fff;
	color: #636b6f;
	font-family: 'Raleway', sans-serif;
	height: 100vh;
	margin: 0;
}

.full-height {
	height: 100vh;
}

.flex-center {
	align-items: center;
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
	font-size: 14px;
}
.description {
width: 400px;
}

.left {
	float: left;
}
.clear {
	clear: both;
}
#notices {
	margin: 10px;
	display: block;
}
.m-b-md {
	margin-bottom: 30px;
}
</style>
</head>
<body>
	<div class="flex-center position-ref full-height">
		<div class="content">
			<h1>Youtube videos</h1>
			<input class="form-control" type="text" id="search-word"
				name="search_word" autofocus />
			<button type="button" class="btn btn-primary" id="search-btn">Search</button>
			<p><i>Enter a search phrase and press enter or click Search button</i></p>
			<div class="clear"></div>
			<span id="notices"></span>
			<div id="list">
			</div>
		</div>
	</div>
</body>
</html>
<script defer src="{{asset('js/app.js')}}"></script>