<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //carga la vista para los usuarios bloqueados
    public function locked(){
        return view('user.locked');
    }
}
