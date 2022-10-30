@extends('layouts.master')
@section('contenido')

<div class="container">
	<h3 class="mt-4">Anuncios borrados</h3>
	<div class="text-start">{{ $anuncios->links() }}</div>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Imagen</th>
			<th>Título</th>
			<th>Descripción</th>
			<th>Precio</th>
			<th>Usuario</th>
			<th></th>
			<th></th>
		</tr>
		@forelse($anuncios as $anuncio)
		<tr>
		<td><b>#{{$anuncio->id}}</b></td>
			<td class="text-center" style="max-width: 80px">
				<img class="rounded" style="max-width: 80%"
						alt="Imagen de {{$anuncio->titulo}}"
						title="Imagen de {{$anuncio->titulo}}"
						src="{{ $anuncio->imagen?
								asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
								asset('/'.config('filesystems.anunciosImageDir')).'/default.jpg'}}">
			</td>
			<td>{{$anuncio->titulo}}</td>
			<td>{{$anuncio->descripcion}}</td>
			<td>{{$anuncio->precio}}</td>
			<td>{{$anuncio->user ? $anuncio->user->name : 'Desconocido'}}</td>
			<td class="text-center">
    			<a href="{{route('anuncios.restore', $anuncio->id)}}">
					<button class="btn btn-success">Restaurar</button>
				</a>
			</td>
			<td>
    			<a href="{{route('anuncios.remove', $anuncio->id)}}">
					<img height="40" width="40"  src="{{asset('images/buttons/delete.png')}}"
					alt="Borrar" title="Borrar">
				</a>
			</td>
		</tr>
		@empty
		<tr>
			<td colspan="8" class="alert alert-danger">No hay anuncios borrados</td>
		</tr>
		@endforelse
	</table>
</div>
@endsection