<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //carga la vista para los usuarios bloqueados
    public function locked(){
        return view('user.locked');
    }
    
    //método que acepta una oferta
    public function gestionarOferta($request){
        //recuperamos los datos del formulario
        
        //si el usuario acepta la oferta
            //se marca como aceptada en la BDD
            //se rechazan todas las otras
            //redirige a la misma vista
        //si no el usuario rechaza la oferta
            //se elimina y se marca como rechazada en la BDD
    }
}
