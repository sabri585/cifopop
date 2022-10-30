@extends('layouts.master')

@section('titulo', "Confirmación de eliminación del $anuncio->titulo")

@section('contenido')
	<div class="my-2 border p-5">
		<form method="POST"
    	      action="{{ route('anuncios.destroy', $anuncio->id)}}">
    		{{csrf_field()}}
    		<input name="_method" type="hidden" value="DELETE">
    		<figure>
    			<figcaption>Imagen actual:</figcaption>
    			<img class="rounded" style="max-width: 400px"
			    alt="Imagen de {{$anuncio->titulo}}"
				title="Imagen de {{$anuncio->titulo}}"
				src="{{ $anuncio->imagen?
						asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
						asset('/'.config('filesystems.anunciosImageDir')).'/default.jpg'}}">
    		</figure>
    		<label for="confirmdelete">Confirmar borrado del {{"$anuncio->titulo"}}:</label>
    		<input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4"
    			value="Borrar" id="confirmdelete">
		</form>
	</div>
@endsection

@section('enlaces')
	@parent
	<a href="{{route('anuncios.index')}}" class="btn btn-primary">Tienda</a>
@endsection