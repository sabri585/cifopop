@extends('layouts.master')
@section('contenido')
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/errores.css')}}">
	</head>
	<div>
		<h1 class="error-container" style="font-size: 3rem">>404 Página No Encontrada</h1>
        <p class="zoom-area title mb-5" style="font-size: 3rem">
        	Lo sentimos pero no podemos encontrar este sitio &#128546;.
    	</p>
        <div class="zoom-area title mb-5" style="font-size: 2rem">
        	{{ $exception->getMessage() }}
        </div>
       <section class="error-container">
            <span class="four"><span class="screen-reader-text">4</span></span>
            <span class="zero"><span class="screen-reader-text">0</span></span>
            <span class="four"><span class="screen-reader-text">4</span></span>
        </section>
	</div>
@endsection