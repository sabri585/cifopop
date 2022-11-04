@extends('layouts.master')
@section('contenido')
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/errores.css')}}">
	</head>
	<div>
		<h1 class="error-container" style="font-size: 3rem">401 No Autorizado</h1>
        <p class="zoom-area title mb-5" style="font-size: 3rem">
        	No tienes permisos para acceder aquí... &#128517;.
    	</p>
        <div class="zoom-area title mb-5" style="font-size: 2rem">
        	{{ $exception->getMessage() }}
        </div>
        <section class="error-container">
            <p style="font-size: 10rem">401</p>
        </section>
	</div>
@endsection
