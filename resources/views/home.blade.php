@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@if (!Auth::user()->email_verified_at)
                <div class="alert alert-danger"> 
                	{{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                	 <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
            	</div>
        	@endif
        	        	
            <div class="card">
                <div class="card-header">{{ __('Hello') }} {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bienvenido/a a tu espacio personal.</p>
                    @if (Auth::user()->hasRole('bloqueado'))
                        <div class="alert alert-danger"> 
                        	Has sido bloqueado y ya no puedes realizar ninguna operación. Por favor,
                        	ponte en <a href="{{ route('contacto') }}"><b>contacto</b></a> con nosotros.
                    	</div>
                	@endif
                   
                    <div>
                    	<b>Tus Datos:</b><br>
                    	<b>Nombre:</b> {{ Auth::user()->name }}<br>
                    	<b>Correo electrónico:</b> {{ Auth::user()->email }}<br>
                    	<b>Teléfono:</b> {{ Auth::user()->telefono }}<br>
                    	<b>Población:</b> {{ Auth::user()->poblacion }}<br>
                    	<b>Fecha de alta:</b> {{ Auth::user()->created_at }}
                    </div>
                </div>
            </div>
        </div>
        @if(!Auth::user()->hasRole(['administrador', 'editor']))
        <div class="mt-4">
            <table class="table table-striped table-bordered">
            	@forelse($anuncios as $anuncio)
            	
            		@if($loop->first)
                		<tr>
                    		<th>ID</th>
                    		<th>Imagen</th>
                    		<th>Título</th>
                    		<th>Descripción</th>
                    		<th>Precio</th>
                    		<th>Total de Ofertas</th>
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
                			<td>{{$anuncio->ofertas_count}}</td>
                			<td>
                    			<a href="{{route('anuncios.show', $anuncio->id)}}">
                					<img height="20" width="20"  src="{{asset('images/buttons/show.png')}}"
                					alt="Ver detalles" title="Ver detalles">
                				</a>
        						<a href="{{route('anuncios.edit', $anuncio->id)}}">
                					<img height="20" width="20"  src="{{asset('images/buttons/update.png')}}"
                					alt="Modificar" title="Modificar">
                				</a>
                				<a href="{{route('anuncios.delete', $anuncio->id)}}">
                					<img height="20" width="20"  src="{{asset('images/buttons/delete.png')}}"
                					alt="Borrar" title="Borrar">
                				</a>
            				</td>
                		</tr>
                    	@if($loop->last)
                    	 	<tr><td colspan="7">Mostrando {{sizeof($anuncios)}} de {{$anuncios->total()}}.</td></tr>
                    	@endif
            	@empty
            		<tr><td colspan="4">No hay resultados que mostrar.</td></tr>
            	@endforelse
            </table>
        </div>
            
        {{-- Anuncios borrados --}}
        <div>
        @if(count($deletedAnuncios))
            <h3 class="mt-4">Anuncios borrados</h3>
            <table class="table table-striped table-bordered">
        		<tr>
            		<th>ID</th>
            		<th>Imagen</th>
            		<th>Título</th>
            		<th>Descripción</th>
            		<th>Precio</th>
            		<th></th>
            		<th></th>
            	</tr>
            	@foreach($deletedAnuncios as $anuncio)
        		<tr>
        			<td><b>#{{$anuncio->id}}</b></td>
        			<td class="text-center" style="max-width: 80px">
        				<img class="rounded" style="max-width: 80%"
        						alt="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
        						title="Imagen de {{$anuncio->marca}} {{$anuncio->modelo}}"
        						src="{{ $anuncio->imagen?
                								asset('/'.config('filesystems.anunciosImageDir')).'/'.$anuncio->imagen:
                								asset('/'.config('filesystems.anunciosImageDir')).'/default.jpg'}}">
        			</td>
        			<td>{{$anuncio->titulo}}</td>
        			<td>{{$anuncio->descripcion}}</td>
        			<td>{{$anuncio->precio}}</td>
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
        		@endforeach
            </table>
        @endif
    	</div>
    	
    	{{-- Ofertas hechas por el usuario --}}
    	<div class="mt-4">
    		<h3 class="mt-4">Ofertas creadas</h3>
            <table class="table table-striped table-bordered">
            	@forelse($ofertas as $oferta)
            	
            		@if($loop->first)
                		<tr>
                    		<th>ID</th>
                    		<th>Texto</th>
                    		<th>Fecha Vigencia</th>
                    		<th>Importe</th>
                    		<th>Fecha de aceptación</th>
                    		<th>Fecha de rechazo</th>
                    		<th>Operaciones</th>
                    	</tr>
                	@endif
                		<tr>
                			<td>{{$oferta->id}}</td>
                			<td>{{$oferta->texto}}</td>
                			<td>{{$oferta->fechaVigencia}}</td>
                			<td>{{$oferta->importe}}</td>
                			<td>{{$oferta->fechaAceptacion}}</td>
                			<td>{{$oferta->fechaRechazo}}</td>
                			<td>
                    			<a href="{{route('anuncios.show', $oferta->anuncio_id)}}">
                					<img height="20" width="20"  src="{{asset('images/buttons/show.png')}}"
                					alt="Ver detalles" title="Ver detalles">
                				</a>
                				<div class="text-center">
                            		<a onclick='if(confirm("¿Estás seguro de que deseas eliminar la oferta?"))
                            						this.nextElementSibling.submit();'>
                            			<button class="btn btn-danger">Eliminar</button>
                            		</a>
                            		<form method="POST" action="{{route('ofertas.destroy', $oferta->id)}}">
                            			{{ csrf_field() }}
                            			<input name="_method" type="hidden" value="DELETE">
                            			<input name="oferta_id" type="hidden" value="{{ $oferta->id }}">
                            		</form>
                        		</div> 
            				</td>
                		</tr>
            	@empty
            		<tr><td colspan="4">No hay resultados que mostrar.</td></tr>
            	@endforelse
            </table>
        </div>
        @endif
	</div>
</div> 
@endsection

@section('enlaces')
@endsection
