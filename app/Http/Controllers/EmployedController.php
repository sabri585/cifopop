<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;

class EmployedController extends Controller
{
    //método que recupera los anuncios que han sido borrados
    public function deletedAnuncios(){
        //recupera los anuncios
        $anuncios = Anuncio::onlyTrashed()->paginate(config('pagination.anuncios', 10));
        
        //carga la vista
        return view('employed.anuncios.deleted', ['anuncios' => $anuncios]);
    }
}
