@extends('layouts.master')
@section('contenido')
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/errores.css')}}">
	</head>
	<div class="vc-container">
      	<div class="vc-content">
       		 <h1 class="vc-heading">500</h1>
    		<p class="vc-sub-heading">Internal Server <span class="blink-infinite">Error</span></p>
      	</div>
    </div>
@endsection