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
    public function store(OfertaRequest $request)
    {
        //recuperar datos del formulario
        $datos = $request->only(['texto', 'fechaVigencia', 'importe']);
        
        //recupera el id del usuario identificado y guardarlo en user_id de la oferta
        $datos['user_id'] = $request->user()->id;
        
        //recupera el id del anuncio que se está mirando y guardarlo en anuncio_id de la oferta
        $datos['anuncio_id'] = $request->user()->id;
        
        //creación y guardado de la nueva oferta con todos los datos
        $oferta = Oferta::create($datos);
        
        return back()->with('success', "Oferta creada satisfactoriamente.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        //pasamos el anuncio a la vista
        return view('anuncios.show', ['oferta'=>$oferta]);
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
