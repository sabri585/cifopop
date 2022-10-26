<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WelcomeController extends Controller
{
    //función index
    public function index(){
        //devuelve la vista de la portada
        return view('welcome');
    }
}
