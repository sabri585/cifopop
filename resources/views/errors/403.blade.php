@extends('layouts.master')
@section('contenido')
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/errores.css')}}">
	</head>
	<div>
		<h1 class="error-container" style="font-size: 3rem">403 Prohibido</h1>
        <p class="zoom-area title mb-5" style="font-size: 3rem">
        	Upss! Parece que no tienes permisos &#128517;.
    	</p>
        <div class="zoom-area title mb-5" style="font-size: 2rem">
        	{{ $exception->getMessage() }}
        </div>
        <section class="error-container">
            <p style="font-size: 10rem">403</p>
        </section>
	</div>
@endsection