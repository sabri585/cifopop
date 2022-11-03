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
			<td>Población</td>
			<td>{{$anuncio->user->poblacion }}</td>
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
        			<img height="20" width="20" src="{{asset('images/buttons/delete.png')}}"
        				alt="Borrar" title="Borrar">
    			</a>
    			@endif
    		</div>
    	</div>
    	
    	{{-- Para crear ofertas --}}
    	@if (! (Auth::user()->hasRole('administrador', 'editor') || Auth::user()->isOwner($anuncio)))
        	<form class="my-2 border p-5" method="POST" action="{{route('ofertas.store')}}" enctype="multipart/form-data">
    		{{csrf_field()}}
        		<div class="card">
                    <div class="card-header">Haz una oferta</div>
                    <div class="form-group row">
            			<label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
            			<input name="texto" type="text" class="up form-control col-sm-10"
            			id="inputTexto" placeholder="Comente su oferta" maxlength="255" required
            			value="{{old('texto')}}">
            			<input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
            		</div>
            		<div class="form-group row">
            			<label for="inputVigencia" class="col-sm-2 col-form-label">Fecha Vigencia</label>
            			<input name="fechaVigencia" type="date" class="up form-control col-sm-10"
            			id="inputVigencia" required>
            		</div>
            		<div class="form-group row">
            			<label for="inputImporte" class="col-sm-2 col-form-label">Importe</label>
            			<input name="importe" type="number" class="up form-control col-sm-4"
            			id="inputImporte" maxlength="11" required min="0" step="0.01"
            			value="{{old('precio')}}">
            		</div>
            		
            		<div>
            			<button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
            			<button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
            		</div>
        		</div>
    		</form>
    	@endif
    	
    	{{-- Para ver las ofertas creadas --}}
    	@if(Auth::user()->isOwner($anuncio) || Auth::user()->hasRole(['administrador', 'editor']))
    		<h3>Ofertas del anuncio</h3>
        	 <table class="table table-striped table-bordered">
        	 @forelse($ofertas as $oferta)
        	 
        	 	@if($loop->first)
        	 	<tr>
        			<th>ID</th>
        			<th>Texto</th>
        			<th>Descripción</th>
        			<th>Importe</th>
        			<th>Propietario</th>
        			<th>Operaciones</th>
    			</tr>
    			@endif
            		<tr>
            			<td>#<b>{{$oferta->id}}</b></td>
            			<td>{{$oferta->texto}}</td>
            			<td>{{$oferta->fechaVigencia}}</td>
            			<td>{{$oferta->importe}}</td>
            			<td>{{$oferta->user_id}}</td>
            			<td>
            				{{-- poner dentro de un form o directamente un enlace que rediriga a otra vista --}}
            				@if(Auth::user()->isOwner($anuncio))
                				<button type="submit" class="btn btn-success m-2 mt-5">Aceptar</button>
                				<button type="submit" class="btn btn-secondary m-2 mt-5">Rechazar</button>
            				@endif
            			</td>
            		</tr>
        		@empty
            		<tr><td colspan="4">No hay resultados que mostrar.</td></tr>
            	@endforelse
    		</table>
		@endif
	@endauth
@endsection

@section('enlaces')
	@parent
@endsection