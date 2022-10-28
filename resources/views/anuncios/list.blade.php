@extends('layouts.master')

@section('titulo', 'Listado de productos')

@section('contenido')
	<div class="row">
		<div class="col-6 text-start">{{ $anuncios->links() }}</div>
		@auth
		<div class="col-6 text-end"><p>Nuevo anuncio <a href="{{route('anuncios.create')}}" class="btn btn-success ml-2">+</a></p></div>
		@endauth
	</div>
	
	<form method="GET" action="{{route('anuncios.search')}}" class="col-6 row">
	
		<input name="titulo" type="text" class="col form-control mr-2 mb-2"
				placeholder="Titulo" maxlength="16"
				value="{{ $titulo ?? '' }}">
				
		<input name="descripcion" type="text" class="col form-control mr-2 mb-2"
				placeholder="Descripcion" maxlength="16" minlength="3"
				value="{{ $descripcion ?? '' }}">
				
		<button type="submit" class="col btn btn-primary mr-2 mb-2">Buscar</button>
		
		<a href="{{ route('anuncios.index') }}">
			<button type="button" class="col btn btn-primary mb-2">Quitar filtro</button>
		</a>
	</form>
	
    <table class="table table-striped table-bordered">
	@forelse($anuncios as $anuncio)
		
		@if($loop->first)
    		<tr>
        		<th>ID</th>
        		<th>Imagen</th>
        		<th>Título</th>
        		<th>Descripción</th>
        		<th>Precio</th>
        		<th>Operaciones</th>
        	</tr>
    	@endif
    		<tr>
    			<td>{{$anuncio->id}}</td>
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
    			<td class="text-center">
    				<a href="{{route('anuncios.show', $anuncio->id)}}">
    					<img height="20" width="20"  src="{{asset('images/buttons/show.png')}}"
    					alt="Ver detalles" title="Ver detalles">
    				</a>
    				@auth
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
    				@endauth
    			</td>
    		</tr>
        	@if($loop->last)
        	 	<tr><td colspan="7">Mostrando {{sizeof($anuncios)}} de {{$anuncios->total()}}.</td></tr>
        	@endif
	@empty
		<tr><td colspan="4">No hay resultados que mostrar.</td></tr>
	@endforelse
    </table>
@endsection

@section('enlaces')
@endsection