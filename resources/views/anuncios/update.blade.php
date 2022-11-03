@extends('layouts.master')

@section('titulo', "Actualización del anuncio $anuncio->titulo")

@section('contenido')
	<form class="my-2 border p-5" method="POST" action="{{route('anuncios.update', $anuncio->id)}}"
		enctype="multipart/form-data">
		{{csrf_field()}}
		<input name="_method" type="hidden" value="PUT">
		
		<div class="form-group row">
			<label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
			<input name="titulo" value="{{$anuncio->titulo}}" type="text"
			class="up form-control col-sm-10" id="inputTitulo" placeholder="Titulo"
			maxlength="255" required>
		</div>
		
		<div class="form-group row">
			<label for="inputDescripcion" class="col-sm-2 col-form-label">Descripcion</label>
			 <input id="inputDescripcion" required value="{{$anuncio->descripcion}}" class="up form-control col-sm-4" name="descripcion">
		</div>
		
		<div class="form-group row">
			<label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
			<input name="precio" value="{{$anuncio->precio}}" type="number"
			class="up form-control col-sm-4" id="inputPrecio" maxlength="11"
			required="required" min="0" step="0.01">
		</div>
		
		<div class="form-group row my-3">
			<div class="col-sm-9">
				<label for="inputImagen" class="col-sm-2 col-form-label">Sustituir imagen</label>
				<input name="imagen" type="file" class="form-control-file" id="inputImagen">
			</div>
			
			<div class="col-sm-3">
				<label>Imagen actual:</label>
				<img class="rounded img-thumbnail my-6"
				    alt="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
					title="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
					src="{{ $anuncio->imagen?
							asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
							asset('/'.config('filesystems.anunciosImageDir')).'/default.png'}}">
			</div>
		</div>
		
		<div class="form-group row">
			<button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
			<button type="reset" class="btn btn-secondary m-2 mt-5">Reestablecer</button>
		</div>
	</form>
        	
	<div class="text-end my-3">
		<div class="btn-group mx-2">
			<a class="mx-2" href="{{route('anuncios.show', $anuncio->id) }}">
				<img height="20" width="20" src="{{asset('images/buttons/show.png')}}"
					alt="Detalles" title="Detalles">
			</a>
			<a class="mx-2" href="{{route('anuncios.delete', $anuncio->id) }}">
				<img height="20" width="20" src="{{asset('images/buttons/delete.png')}}"
					alt="Borrar" title="Borrar">
			</a>
		</div>
	</div>
@endsection

@section('enlaces')
	@parent
@endsection