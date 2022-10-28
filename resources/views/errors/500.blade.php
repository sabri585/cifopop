<div class="vc-container">
  <div class="vc-content">
    <h1 class="vc-heading">500</h1>
    <p class="vc-sub-heading">Internal Server <span class="blink-infinite">Error</span></p>
  </div>
</div>
@extends('layouts.master')
 	@php
 	 	include 'css/errores.css';
	@endphp
@section('titulo','Error 500')
@section('contenido')
	<div>
		<h1>500 Internal Server Error</h1>
        <section class="error-container">
            <span class="four"><span class="screen-reader-text">5</span></span>
            <span class="zero"><span class="screen-reader-text">0</span></span>
            <span class="four"><span class="screen-reader-text">0</span></span>
        </section>
	</div>
@endsection

@section('enlaces')
	@parent
	 <div class="link-container">
    	<a href="{{route(anuncios.index')}}" class="more-link">Inicio</a>
    </div>
@endsection