@extends('layouts.master')

@section('titulo', 'Nuevo Anuncio')

@section('contenido')
        
	<form class="my-2 border p-5" method="POST" action="{{route('anuncios.store')}}" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="form-group row">
			<label for="inputTitulo" class="col-sm-2 col-form-label">Titulo</label>
			<input name="titulo" type="text" class="up form-control col-sm-10"
			id="inputTitulo" placeholder="Titulo" maxlength="255" required
			value="{{old('titulo')}}">
		</div>
		
		<div class="form-group row"> 
			<label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción</label>
			<input name="descripcion" class="up form-control col-sm-4"
			id="inputDescripcion" required value="{{old('descripcion')}}">
		</div>
		
		<div class="form-group row">
			<label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
			<input name="precio" type="number" class="up form-control col-sm-4"
			id="inputPrecio" maxlength="11" required min="0" step="0.01"
			value="{{old('precio')}}">
		</div><br>
		
		<div class="form-group row">
			<label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
			<input name="imagen" type="file" class="form-control-file col-sm-10"
			id="inputImagen">
		</div>
		
		<div>
			<button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
			<button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
		</div>
	</form>
	@endsection
	
	@section('enlaces')
		@parent
		<a href="{{route('anuncios.index')}}" class="btn btn-primary m-2">Tienda</a>
	@endsection
