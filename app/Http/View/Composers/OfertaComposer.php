<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Oferta;

class OfertaComposer{
    
    //método que vincula la información a la vista
    public function compose(View $view){
        $view->with('totalOfertas', Oferta::count());
    }
}
