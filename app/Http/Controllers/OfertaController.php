<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfertaRequest;
use App\Models\Oferta;
use App\Models\Anuncio;

class OfertaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        
        //middleware is_not_employed para la creación de ofertas
        $this->middleware('is_not_employed')->only('store');
    }
    
    public function store(OfertaRequest $request, Anuncio $anuncio)
    {
        //recuperar datos del formulario
        $datos = $request->only(['texto', 'fechaVigencia', 'importe', 'anuncio_id']);
        
        //recupera el id del usuario identificado y guardarlo en user_id de la oferta
        $datos['user_id'] = $request->user()->id;
        
        //creación y guardado de la nueva oferta con todos los datos
        $oferta = Oferta::create($datos);
        
        return back()->with('success', "Oferta creada satisfactoriamente.");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //busca la oferta seleccionada
        $oferta = Oferta::findOrFail($id);
        
        //la borra de la BDD
        $oferta->delete();
        
        //redirige a la vista anterior
        return back()->with('success', "Oferta eliminada satisfactoriamente.");
    }
}
