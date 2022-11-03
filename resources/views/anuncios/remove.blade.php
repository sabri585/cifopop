@extends('layouts.master')

@section('titulo', "Confirmación de eliminación del $anuncio->titulo")

@section('contenido')
	<div class="my-2 border p-5">
		<form method="POST"
    	      action="{{URL::temporarySignedRoute('anuncios.purge', now()->addMinutes(1))}}">
    		{{csrf_field()}}
    		<input name="_method" type="hidden" value="DELETE">
    		<input name="anuncio_id" type="hidden" value="{{ $anuncio->id }}">
    		<figure>
    			<figcaption>Imagen actual:</figcaption>
    			<img class="rounded" style="max-width: 400px"
			    alt="Imagen de {{$anuncio->titulo}}"
				title="Imagen de {{$anuncio->titulo}}"
				src="{{ $anuncio->imagen?
						asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
						asset('/'.config('filesystems.anunciosImageDir')).'/default.jpg'}}">
    		</figure>
    		<label for="confirmremove">¿Está seguro que desea eliminar definitivamente el
    		{{"$anuncio->titulo"}}? Esta acción no se puede revertir.</label>
    		<input type="submit" alt="Eliminar" title="Eliminar definitivamente" class="btn btn-danger m-4"
    			value="Eliminar" id="confirmremove">
		</form>
	</div>
@endsection

@section('enlaces')
	@parent
	<a href="{{route('anuncios.show', $anuncio->id)}}" class="btn btn-primary mr-2">
		Regresar a detalles del anuncio</a>
@endsection
