<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    //campos de la BDD en los que se permite la asignación masiva
    protected $fillable = ['rol'];
    
    //Método que recupera los usuarios con un determinado rol
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
