<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        //cargar la vista de home pasándole los anuncios
        return view('home', ['anuncios' => $anuncios, 'deletedAnuncios' => $deletedAnuncios]);
    }
}
