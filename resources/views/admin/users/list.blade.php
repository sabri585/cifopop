@extends('layouts.master')

@section('titulo', 'Lista de usuarios')

@section('contenido')
	<div class="row p-3">
		<div class="col-4"></div>
		<form method="GET" action="{{route('admin.users.search')}}" class="col-8">
    		<div class="row">
    			<input name="name" type="text" class="col form-control mr-2 mb-2"
    				placeholder="Nombre" maxlength="16"
    				value="{{ $name ?? '' }}">
    				
        		<input name="email" type="text" class="col form-control mr-2 mb-2"
        				placeholder="Email" maxlength="16"
        				value="{{ $email ?? '' }}">
        				
        		<button type="submit" class="col btn btn-primary mr-2 mb-2">Buscar</button>
        		
        		<a href="{{ route('admin.users') }}">
        			<button type="button" class="col btn btn-primary mb-2">Quitar filtro</button>
        		</a>
    		</div>
		</form>
	</div>
	<div>{{ $users->links() }}</div>
    <table class="table table-striped table-bordered">
		<tr>
    		<th>ID</th>
    		<th>Nombre</th>
    		<th>Email</th>
    		<th>Fecha de alta</th>
    		<th>Roles</th>
    		<th>Operaciones</th>
    	</tr>
    	@foreach($users as $u)
    		<tr>
    			<td class="text-center">#<b>{{$u->id}}</b></td>
    			<td><a href="{{route('admin.user.show',$u->id)}}"><b>{{$u->name}}</b></a></td>
    			<td><a href="mailto:{{$u->email)}}">{{$u->email}}</a></td>
    			<td class="small text-start">
    				@foreach($u->roles as $rol)
    				- {{$rol->rol}}<br>
				</td>
    			<td class="text-center">
    				<a href="{{route('admin.user.show', $u->id)}}">
    					<img height="20" width="20"  src="{{asset('images/buttons/show.png')}}"
    					alt="Ver detalles" title="Ver detalles">
    				</a>
    			</td>
    		</tr>
		@endforeach
    </table>
@endsection

@section('enlaces')
@endsection