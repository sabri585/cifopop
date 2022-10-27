@extends('layouts.master')

@section('titulo', 'Contáctanos')

@section('contenido')
	
	<div class="container row">
		<form class="col-12 mt-2 mb-2 p-4" method="POST"
			action="{{route('contacto.email')}}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group row">
				<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
				<input name="email" type="email" class="up form-control"
					id="inputEmail" placeholder="Email" maxlength="255" required
					value="{{old('email')}}">
			</div>
			
			<div class="form-group row">
				<label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
				<input name="nombre" type="text" class="up form-control"
					id="inputNombre" placeholder="Nombre" maxlength="255" required
					value="{{old('nombre')}}">
			</div>
			
			<div class="form-group row">
				<label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
				<input name="asunto" type="text" class="up form-control"
					id="inpuAsunto" placeholder="Asunto" maxlength="255" required
					value="{{old('asunto')}}">
			</div>
			
			<div class="form-group row">
				<label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
				<textarea name="mensaje" class="up form-control"
					id="inpuMensaje" maxlength="2048" required>{{old('mensaje')}}
				</textarea>
			</div>
			
			<div class="form-group row my-4">
				<label for="inputFichero" class="form-label">Fichero (PDF):</label>
				<input name="fichero" type="file" class="form-control-file"
					id="inpuFichero" accept="application/pdf">
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success m-2">Enviar</button>
				<button type="reset" class="btn btn-secondary m-2">Borrar</button>
			</div>
		</form>
		
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985
			.647615286079!2d2.0558356156558917!3d41.55522649353594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13
			.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCIFO%20Sabadell!5e0!3m2!1ses!2ses!4v1664977923242!5m2!1ses!2ses"
			style="min-width:300px; min-height:300px;" loading="lazy"
			class="col-5 my-2 p-3" 
			referrerpolicy="no-referrer-when-downgrade">
		</iframe>
	</div>
@endsection

@section('enlaces')
	@parent
	<a href="{{route('anuncios.index')}}" class="btn btn-primary m-2">Tienda</a>
@endsection