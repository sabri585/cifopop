<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anuncio extends Model
{
    use HasFactory, SoftDeletes;
    
    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = ['titulo', 'descripcion', 'precio', 'imagen','user_id'];
    
    //retorna el usuario propietario del anuncio
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
