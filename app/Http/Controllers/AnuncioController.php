<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Http\Requests\AnuncioRequest;
use App\Http\Requests\AnuncioUpdateRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class AnuncioController extends Controller
{
    /**
     * Constructor del controlador.
     */
    public function __construct(){
        //definimos el middleware
        /*ponemos el middleware auth o verified a todos los métodos excepto:
         * - lista de anuncios
         * - detalles del anuncio
         */
        $this->middleware('verified')->except('index', 'show', 'search');
        
        //middleware is_not_employed para la creación de anuncios
        $this->middleware('is_not_employed')->only('create', 'store');
        
        //el método para eliminar un anuncio requiere confirmación de clave
        $this->middleware('password.confirm')->only('purge');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recuperar los anuncios de la BBD usando el modelo
        $anuncios = Anuncio::orderBy('id', 'DESC')->paginate(15);
        
        //carga la vista para el listado
        return view('anuncios.list', ['anuncios'=>$anuncios]);
    }
    
    /**
     * Método que busca un anuncio.
     *
     * @param string $titulo, string $descripcion
     * @return  \Illuminate\Http\Response
     */
    public function search(Request $request){
        //comprobar que llegan los parámetros
        $request->validate([
            'titulo' => 'required|string|min:3',
            'descripcion' => 'string|min:3|nullable'
        ]);
        
        //realiza la consulta
        //tomar los valores que llegan para titulo y descripción
        $titulo = $request->input('titulo','');
        $descripcion = $request->input('descripcion','');
        
        /*recupera los resultados, añadimos titulo y descripcion al paginador
         para que haga bien los enlaces y se mantenga el filtro al pasar de página*/
        $anuncios = Anuncio::where('titulo','like',"%$titulo%")
        ->where('descripcion','like',"%$descripcion%")
        ->paginate(config('paginator.anuncios'))
        ->appends(['titulo'=>$titulo,'descripcion'=>$descripcion]);
        
        //retorna la vista de lista con el filtro aplicado
        return view('anuncios.list', ['anuncios'=>$anuncios, 'titulo'=>$titulo, 'descripcion'=>$descripcion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {        
        //muestra el formulario
        return view('anuncios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnuncioRequest $request)
    {
        //recuperar datos del formulario excepto la imagen
        $datos = $request->only(['titulo', 'descripcion', 'precio']);
        
        //el valor por defecto para la imagen será 'default.png'
        $datos += ['imagen' => '/images/anuncios/default.png'];
        
        //recuperación de la imagen
        if ($request->hasFile('imagen')) {
            
            //para guardar la extensión del fichero
            $extension = $request->file('imagen')->extension();
            
            //sube la imagen al directorio indicado en el fichero de config
            $ruta = $request->file('imagen')->storeAs("/", uniqid().'.'.$extension);
            
            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }
        
            //recupera el id del usuario identificado y guardarlo en user_id del anuncio
            $datos['user_id'] = $request->user()->id;

            //creación y guardado del nuevo anuncio con todos los datos
            $anuncio = Anuncio::create($datos);
            
            //redirección a los detalles del anuncio creado
            return redirect()
            ->route('anuncios.show', $anuncio->id)
            ->with('success', "Anuncio $anuncio->titulo añadido satisfactoriamente")
            ->cookie('lastInsertID', $anuncio->id, 0); //adjuntamos una cookie
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {
        //recuperar todas las ofertas del anuncio
        $ofertas = DB::table('ofertas')
        ->join('anuncios', 'anuncios.id', '=', 'ofertas.anuncio_id')
        ->join('users', 'users.id', '=', 'ofertas.user_id')
        ->select('ofertas.*', 'users.name', 'users.email', 'anuncios.titulo')
        ->where('ofertas.anuncio_id', '=', $anuncio->id)
        ->get();
        
        //cargar la vista y pasarle el anuncio
        return view('anuncios.show', ['anuncio'=>$anuncio, 'ofertas'=>$ofertas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Anuncio $anuncio)
    {
        //autorización mediante policy
        if ($request->user()->cant('update', $anuncio)) {
             abort(401, 'No puedes actualizar un anuncio que no es tuyo');
         }
        
        //carga la vista con el formulario para modificar el anuncio
        return view('anuncios.update', ['anuncio'=>$anuncio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnuncioUpdateRequest $request, Anuncio $anuncio)
    {
        //autorización mediante policy
        /*if ($request->user()->cant('update', $anuncio)) {
            abort(401, 'No puedes actualizar un anuncio que no es tuyo');
        }
        */
        //tomar los datos del formulario
        $datos = $request->only('titulo', 'descripcion', 'precio');
        
        //si llega una nueva imagen...
        if ($request->hasFile('imagen')) {
            //marcamos la imagen antigua para ser borrada si el update va bien
            if ($anuncio->imagen) {
                $aBorrar = config('filesystems.anunciosImageDir').'/'.$anuncio->imagen;
            }
            
            //para guardar la extensión del fichero
            $extension = $request->file('imagen')->extension();
            
            //sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->storeAs("/", uniqid().'.'.$extension);
            
            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }
        
        //al actualizar debemos tener en cuenta varias cosas:
        if ($anuncio->update($datos)) { //si todo va bien
            if (isset($aBorrar)) {
                File::delete($aBorrar); //borramos foto antigua
            }
        }else{ //si algo falla
            if (isset($imagenNueva)) {
                File::delete($imagenNueva); //borramos la imagen nueva
            }
        }
        
        //encola las cookies
        Cookie::queue('lastUpdateID', $anuncio->id, 0);
        Cookie::queue('lastUpdateDate', now(), 0);
        
        //carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Anuncio $anuncio->titulo actualizado satisfactoriamente");
    }

    /**
     * Muestra el formulario de confirmación de borrado del anuncio (soft deletes).
     *
     * @param  int  $id, Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Anuncio $anuncio)
    {        
        //autorización mediante policy
         if ($request->user()->cant('delete', $anuncio)) {
             abort(401, 'No puedes borrar un anuncio que no es tuyo');
         }
         
        //recuerda la URL anterior para futuras redirecciones
        Session::put('returnTo', URL::previous());
        
        //muestra la vista de confirmación de eliminación
        return view('anuncios.delete', ['anuncio'=>$anuncio]);
    }
    
    /**
     * Remove the specified resource from storage (soft deletes).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Anuncio $anuncio)
    {
        //autorización mediante policy
         if ($request->user()->cant('delete', $anuncio)) {
             abort(401, 'No puedes borrar un anuncio que no es tuyo');
         }
//          dd($request->input('id'));
        //soft delete
        $anuncio->delete();
        
        
        
        //comprobamos si hay que retornar a algún sitio concreto
        $redirect = Session::has('returnTo') ?
        redirect(Session::get('returnTo')) : //por URL
        redirect()->route('anuncios.index'); //por nombre de ruta TODO: no funciona con show
        
        //borramos la variable de sesión si la hubiera
        Session::remove('returnTo');
        
        //redirige a la vista anterior
        return $redirect->with('success', "Anuncio $anuncio->titulo eliminado");
    }
    
    /**
     * Muestra el formulario de confirmación de eliminación definitiva del anuncio.
     *
     * @param  int  $id, Request $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, int $id)
    {
        //recupera el anuncio a eliminar
        $anuncio = Anuncio::withTrashed()->find($id);
        
        //autorización mediante policy
        if ($request->user()->cant('delete', $anuncio)) {
            abort(401, 'No puedes borrar un anuncio que no es tuyo');
        }
        
        //recuerda la URL anterior para futuras redirecciones
        Session::put('returnTo', URL::previous());
        
        //muestra la vista de confirmación de eliminación
        return view('anuncios.remove', ['anuncio'=>$anuncio]);
    }
        
    /**
     * Método que elimina el anuncio definitivamente.
     *
     * @param request
     */
    public function purge(Request $request){
        
        //recuperar la moto borrada
        $anuncio = Anuncio::withTrashed()->find($request->input('anuncio_id'));

        //autorización mediante policy
        if ($request->user()->cant('delete', $anuncio)) {
          abort(401, 'No puedes borrar un anuncio que no es tuyo');
        }
        
        //si se consigue eliminar definitivamente el anuncio y tiene foto...
        if ($anuncio->forceDelete() && $anuncio->imagen) {
            //borra también la foto
            File::delete(config('filesystems.bikesImageDir').'/'.$anuncio->imagen);
        }
        
        //comprobamos si hay que retornar a algún sitio concreto
        $redirect = Session::has('returnTo') ?
        redirect(Session::get('returnTo')) : //por URL
        redirect()->route('anuncios.index'); //por nombre de ruta
        
        //borramos la variable de sesión si la hubiera
        Session::remove('returnTo');
        
        //redirección
        return $redirect->with('success', "Anuncio $anuncio->titulo eliminado");
    }
    
    /**
     * Método que recupera el anuncio borrado.
     *
     * @param id, Request
     * @return  Anuncio
     */
    public function restore(Request $request, int $id){
        
        //recupera el anuncio borrado
        $anuncio = Anuncio::withTrashed()->find($id);
        
        //comprobación de permisos
        if ($request->user()->cant('restore', $anuncio)) {
            throw new AuthorizationException('No tienes permiso');
        }
        
        //restaura el anuncio
        $anuncio->restore();
        
        return back()->with('success', "Anuncio $anuncio->titulo restaurado satisfactoriamente.");
    }
}
