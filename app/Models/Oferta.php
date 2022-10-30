<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    
    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = ['texto', 'fechaVigencia', 'importe', 'fechaAceptacion', 'fechaRechazo', 'anuncio_id', 'user_id'];
    
    //retorna el usuario propietario de la oferta
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
