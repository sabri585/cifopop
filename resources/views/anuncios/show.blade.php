@extends('layouts.master')

@section('titulo', "Detalles de la moto $bike->marca $bike->modelo")

@section('contenido')
	<table class="table table-striped table-bordered">
		<tr>
			<td>ID</td>
			<td>{{$bike->id}}</td>
		</tr>
		<tr>
			<td>Marca</td>
			<td>{{$bike->marca}}</td>
		</tr>
		<tr>
			<td>Modelo</td>
			<td>{{$bike->modelo}}</td>
		</tr>
		<tr>
			<td>Propietario</td>
			<td>{{$bike->user? $bike->user->name : 'Sin propietario'}}</td>
		</tr>
		<tr>
			<td>Precio</td>
			<td>{{$bike->precio}}</td>
		</tr>
		<tr>
			<td>Kms</td>
			<td>{{$bike->kms}}</td>
		</tr>
		<tr>
			<td>Matriculada</td>
			<td>{{$bike->matriculada? 'SI' : 'NO'}}</td>
		</tr>
		@if($bike->matriculada)
		<tr>
			<td>Matrícula</td>
			<td>{{$bike->matricula}}</td>
		</tr>
		@endif
		
		@if($bike->color)
		<tr>
			<td>Color</td>
			<td style="background-color:{{$bike->color}}">{{$bike->color}}</td>
		</tr>
		@endif
		
		<tr>
			<td>Imagen</td>
			<td class="text-start">
				<img class="rounded" style="max-width: 400px"
				    alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
					title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
					src="{{ $bike->imagen?
							asset('/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
							asset('/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
		</tr>
	</table>
	
	@auth
    <div class="text-end my-3">
    	<div class="btn-group mx-2">
        	@if(Auth::user()->can('update', $bike))
    			<a href="{{route('bikes.edit', $bike->id)}}">
    				<img height="20" width="20"  src="{{asset('images/buttons/update.png')}}"
    				alt="Modificar" title="Modificar">
    			</a>
    		@endif
			@if(Auth::user()->can('delete', $bike))
    			<form method="POST" action="{{route('bikes.destroy', $bike->id )}}">
        			{{ csrf_field() }}
        			<input name="_method" type="hidden" value="DELETE">
        			<input type="image" alt="Eliminar" src="{{asset('images/buttons/delete.png')}}" height="20" width="20">
        		</form>
			@endif
		</div>
	</div>
	@endauth
@endsection

@section('enlaces')
	@parent
	<a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection