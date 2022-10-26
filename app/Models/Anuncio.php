<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;
    
    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = ['titulo', 'descripcion', 'precio', 'imagen'];
}
