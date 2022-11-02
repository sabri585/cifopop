<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Anuncio;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        //recuperar los anuncios no borrados del usuario
        $anuncios = $request->user()->anuncios()->paginate(config('pagination.anuncios', 10));
        
        //recuperar los anuncios borrados del usuario
        $deletedAnuncios = $request->user()->anuncios()->onlyTrashed()->get();
        
        //total de ofertas por anuncio TODO: no funciona correctamente
//         $total = DB::table('ofertas')->where('ofertas.anuncio_id', '=', $request->user())->count();
        
        $prueba = $request->user()->anuncios;
        dd($prueba);
        
        //recuperar todas las ofertas
        $ofertas = DB::table('ofertas')
            ->join('anuncios', 'anuncios.id', '=', 'ofertas.anuncio_id')
            ->join('users', 'users.id', '=', 'ofertas.user_id')
            ->select('ofertas.*', 'users.name', 'users.email', 'anuncios.titulo')
            ->where('ofertas.user_id', '=', $request->user()->id)
            ->get();
        
        //recuperar las ofertas que el usuario ha hecho a otros
//         $ofertas = $request->user()->ofertas()->paginate(config('pagination.anuncios', 10));
        
        //cargar la vista de home pasándole los anuncios
            return view('home', ['anuncios'=>$anuncios, 'deletedAnuncios'=>$deletedAnuncios,
                            'ofertas'=>$ofertas, 'total'=>$total]);
    }
}
