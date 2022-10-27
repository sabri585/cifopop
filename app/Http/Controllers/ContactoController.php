<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class ContactoController extends Controller
{
    //método index
    public function index(){
        return view('contacto');
    }
    
    //método que envía el email
    public function send(Request $request){
        
        //validaciones
        $request->validate([
            //'asunto' => 'required|[A-Za-z0-9]',
            'email' => 'required|email:rfc',
            //'nombre' => 'required|[A-Za-z]',
            'fichero' => 'sometimes|file|mimes:pdf'
        ]);
        
        $mensaje = new \stdClass(); //objeto con los datos
        $mensaje->asunto = $request->asunto;
        $mensaje->email = $request->email;
        $mensaje->nombre = $request->nombre;
        $mensaje->mensaje = $request->mensaje;
        
        //si se envió el fichero recupera la ruta (en el directorio temporal)
        $mensaje->fichero = $request->hasFile('fichero')?
        $request->file('fichero')->getRealPath() : NULL;
   
        Mail::to('info@cifopop.com')->send(new Contact($mensaje));
        
        return redirect()->route('portada')->with('success', 'Mensaje enviado correctamente.');
    }
}
