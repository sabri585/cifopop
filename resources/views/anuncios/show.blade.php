@extends('layouts.master')

@section('titulo', "Detalles del anuncio $anuncio->titulo")

@section('contenido')
	<table class="table table-striped table-bordered">
		<tr>
			<td>ID</td>
			<td>{{$anuncio->id}}</td>
		</tr>
		<tr>
			<td>Título</td>
			<td>{{$anuncio->titulo}}</td>
		</tr>
		<tr>
			<td>Descripción</td>
			<td>{{$anuncio->descripcion}}</td>
		</tr>
		<tr>
			<td>Propietario</td>
			<td>{{$anuncio->user? $anuncio->user->name : 'Sin propietario'}}</td>
		</tr>
		<tr>
			<td>Precio</td>
			<td>{{$anuncio->precio}}</td>
		</tr>
		<tr>
			<td>Fecha de publicación</td>
			<td>{{$anuncio->created_at}}</td>
		</tr>
		<tr>
			<td>Imagen</td>
			<td class="text-start">
				<img class="rounded" style="max-width: 400px"
				    alt="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
					title="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
					src="{{ $anuncio->imagen?
							asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
							asset('/'.config('filesystems.anunciosImageDir')).'/default.jpg'}}">
		</tr>
	</table>
	
	@auth
    <div class="text-end my-3">
    	<div class="btn-group mx-2">
        	@if(Auth::user()->can('update', $anuncio))
    			<a href="{{route('anuncios.edit', $anuncio->id)}}">
    				<img height="20" width="20"  src="{{asset('images/buttons/update.png')}}"
    				alt="Modificar" title="Modificar">
    			</a>
    		@endif
			@if(Auth::user()->can('delete', $anuncio))
			<a class="mx-2" href="{{route('anuncios.delete', $anuncio->id) }}">
    			<img height="40" width="40" src="{{asset('images/buttons/delete.png')}}"
    				alt="Borrar" title="Borrar">
			</a>
			@endif
		</div>
	</div>
	@endauth
@endsection

@section('enlaces')
	@parent
	<a href="{{route('anuncios.index')}}" class="btn btn-primary m-2">Tienda</a>
@endsection