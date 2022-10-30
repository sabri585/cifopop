@extends('layouts.master')

@section('contenido')
	<div class="container row mt-2">
		<div class="col-10 alert alert-danger p-4">
			<p>Has sido <b>bloqueado</b> por un administrador.</p>
			<p>Si no estás de acuerdo o quieres cononcer los motivos, contacta mediante el
				<a href="{{ route('contacto') }}">formulario de contacto</a>.</p>
		</div>
		<figure class="col-2">
    		<img class="rounded img-fluid" alt="Usuario bloqueado"
    			src="{{ asset('/'.config('filesystems.usersImageDir')).'/locked.png'}}">
    		<figcaption class="figure-caption text-center">Usuario bloqueado</figcaption>
		</figure>
	</div>
@endsection
