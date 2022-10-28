@extends('layouts.master')
 	@php
 	 	include 'css/errores.css';
	@endphp
@section('titulo','Error 503')
@section('contenido')
	<div>
		<h1>503 Servicio No Disponible</h1>
        <p class="zoom-area title mb-5" style=font-size: 3rem">
        	Estamos arreglando cositas para una mayor experiencia.
			Volvemos pronto &#128526;.
    	</p>
        <div class="zoom-area title mb-5" style=font-size: 2rem">
        	{{ $exception->getMessage() }}
        </div>
        <section class="error-container">
            <span class="four"><span class="screen-reader-text">5</span></span>
            <span class="zero"><span class="screen-reader-text">0</span></span>
            <span class="four"><span class="screen-reader-text">3</span></span>
        </section>
	</div>
@endsection

@section('enlaces')
	@parent
	 <div class="link-container">
    	<a href="{{route(anuncios.index')}}" class="more-link">Inicio</a>
    </div>
@endsection
