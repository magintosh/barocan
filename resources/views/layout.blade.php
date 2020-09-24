<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/spectrum.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css?v2.2') }}" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/iziToast.min.js') }}"></script>
		<script src="{{ asset('js/jquery.tmpl.min.js') }}"></script>
		<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
		<script src="{{ asset('js/spectrum.js') }}"></script>
		<script src="{{ asset('js/custom.js?v=1.4') }}"></script>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
	</head>
    <body>
		@yield('header')
		@yield('sub_content')
        @include('partials.alerts')
        <div class="container">
			<div class="row">
				@yield('content')
			</div>
		</div>
	</body>
</html>
