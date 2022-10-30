<!DOCTYPE html>
<html lang="es">
    <head>
    <!-- Etiquetas META -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Aplicación de segunda mano CIFOPOP">
		
		<!-- Título de la página -->
        <title>{{config('app.name')}} - @yield('titulo')</title>

        <!-- Carga el CSS de Bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    </head>
    
    <body class="container p-3">
    
    	<!-- Parte superior (menú) -->
    	@env(['local','test'])
    		<div class="alert alert-warning">
    			<b>Atención:</b> estás probando la aplicación en modo local o test.
    		</div>
    	@endenv
    	
    	@section('navegación')
    	@php($pagina = Route::currentRouteName())
        <nav>
        	<ul class="nav nav-pills my-3">
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina=='portada'? 'active':''}}" href="{{route('portada')}}">Inicio</a>
        		</li>
        		
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina=='anuncios.index'? 'active':''}}" href="{{route('anuncios.index')}}">Tienda</a>
        		</li>
        		
        		<li class="nav-item mr-2">
        			<a class="nav-link {{$pagina=='contacto'? 'active':''}}" href="{{route('contacto')}}">Contacto</a>
        		</li>
        		@auth
        			@if(!Auth::user()->hasRole('bloqueado', 'administrador', 'editor'))
                		<li class="nav-item mr-2">
        						<a class="nav-link {{$pagina=='anuncios.create'? 'active':''}}" href="{{route('anuncios.create')}}">Nuevo anuncio</a>
                		</li>
            		@endif
        		
            		@if(Auth::user()->hasRole('administrador','editor'))
            			<li class="nav-item mr-2">
            				<a class="nav-link {{$pagina=='employed.deleted.anuncios'? 'active':''}}" href="{{route('employed.deleted.anuncios')}}">Anuncios borrados</a>
            			</li>
        			@endif
    			
    				@if(Auth::user()->hasRole('administrador'))
        			<li class="nav-item mr-2">
        				<a class="nav-link {{$pagina=='admin.locked.users'? 'active':''}}" href="{{route('admin.locked.users')}}">Usuarios bloqueados</a>
        			</li>
        			
        			<li class="nav-item mr-2">
        				<a class="nav-link {{$pagina=='admin.users' || $pagina=='admin.users.search' ? 'active':''}}"
        					href="{{route('admin.users')}}">Gestión de usuarios</a>
        			</li>
        			@endif
        		@endauth
        		
        		@guest
                    @if (Route::has('login'))
                        <li class="nav-item mr-2">
                            <a class="nav-link {{$pagina=='login'? 'active':''}}" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                    @endif
    
                    @if (Route::has('register'))
                        <li class="nav-item mr-2">
                            <a class="nav-link {{$pagina=='register'? 'active':''}}" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-group row">   
                    <a id="" class="nav-link col" href="{{route('home')}}" role="button" >
                        {{ Auth::user()->name }}
                    </a>
                    <a class="nav-link col" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
        	</ul>
        </nav>
        @show
        
        <!-- Parte central -->
        <h1 class="my-2">Tienda de segunda mano Cifopop</h1>
        
        <main>
        	<h2>@yield('titulo')</h2>
        	
         	@includeWhen(Session::has('success'), 'layouts.success') 
         	@includeWhen($errors->any(), 'layouts.error') 
        	
        	@yield('contenido')
        	
        	<div class="btn-group" role="group" label="Links">
        	@section('enlaces')
        		<a href="{{url()->previous()}}" class="btn btn-primary m-2">Atrás</a>
        	</div>
        	@show
        </main>
        
        <!-- Parte Inferior -->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
        	<p>Aplicación creada por {{ $autor }} y desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b> para el proyecto de clase.</p>
        </footer>
        @show
    </body>
</html>
