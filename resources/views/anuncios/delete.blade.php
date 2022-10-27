@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $bike->marca $bike->modelo")

@section('contenido')
	<div class="my-2 border p-5">
		<form method="POST"
    	      action="{{URL::temporarySignedRoute('bikes.purge', now()->addMinutes(1))}}">
    		{{csrf_field()}}
    		<input name="_method" type="hidden" value="DELETE">
    		<input name="bike_id" type="hidden" value="{{ $bike->id }}">
    		<figure>
    			<figcaption>Imagen actual:</figcaption>
    			<img class="rounded" style="max-width: 400px"
			    alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
				title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
				src="{{ $bike->imagen?
						asset('/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
						asset('/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
    		</figure>
    		<label for="confirmdelete">Confirmar el borrado de {{"$bike->marca $bike->modelo"}}: </label>
    		<input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4"
    			value="Borrar definitivamente" id="confirmdelete">
		</form>
	</div>
@endsection

@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary">Garaje</a>
	<a href="{{route('bikes.show', $bike->id)}}" class="btn btn-primary mr-2">
		Regresar a detalles de la moto</a>
@endsection