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
    	@if(!Auth::user()->hasRole('bloqueado'))
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
    	@endif
    	
    	@if (!Auth::user()->hasRole('bloqueado', 'administrador', 'editor'))
        	<form class="my-2 border p-5" method="POST" action="{{route('ofertas.store')}}" enctype="multipart/form-data">
    		{{csrf_field()}}
        		<div class="card">
                    <div class="card-header">Haz una oferta</div>
                    <div class="form-group row">
            			<label for="inputTexto" class="col-sm-2 col-form-label">Texto</label>
            			<input name="texto" type="text" class="up form-control col-sm-10"
            			id="inputTexto" placeholder="Comente su oferta" maxlength="255" required
            			value="{{old('texto')}}">
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
    	{{-- Añadir permisos a la oferta solo para que el usuario que lo ha creado y el propietario lo pueda ver--}}
    	 <table class="table table-striped table-bordered">
        	@forelse($ofertas as $oferta)
            	<tr>
        			<td>Texto</td>
        			<td>{{$oferta->texto}}</td>
        		</tr>
        		<tr>
        			<td>Descripción</td>
        			<td>{{$oferta->descripcion}}</td>
        		</tr>
        		<tr>
        			<td>Importe</td>
        			<td>{{$oferta->importe}}</td>
        		</tr>
        		<tr>
        			<td>Propietario</td>
        			<td>{{$oferta->user? $oferta->user->name : 'Sin propietario'}}</td>
        		</tr>
    		@endforelse
		</table>
		<div class="text-center">
    		<a onclick='if(confirm("¿Estás seguro de que deseas eliminar la oferta?"))
    						this.nextElementSibling.submit();'>
    			<button class="btn btn-danger">Eliminar</button>
    		</a>
    		<form method="POST" class="d-none" action="{{ route('ofertas.destroy') }}">
    			@csrf
    			<input name="_method" type="hidden" value="DELETE">
    			<input name="bike_id" type="hidden" value="{{ $bike->id }}">
    		</form>
		</div>
	@endauth
@endsection

@section('enlaces')
	@parent
	<a href="{{route('anuncios.index')}}" class="btn btn-primary m-2">Tienda</a>
@endsection