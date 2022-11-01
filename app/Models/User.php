<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'poblacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //método que recupera todos los anuncios relacionados con el usuario
    //como la relación es 1 a N, usaremos el método hasMany()
    public function anuncios(){
        return $this->hasMany('App\Models\Anuncio');
    }
    
    //método que recupera todas las ofertas relacionadas con el usuario
    //como la relación es 1 a N, usaremos el método hasMany()
//     public function ofertas(){
//         return $this->hasMany('App\Models\Oferta');
//     }
    
    //Método que recupera los roles de un usuario
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }
    
    //recupera los roles que no tiene el usuario
    public function remainingRoles(){
        
        $actualRoles = $this->roles; //user roles
        $allRoles = Role::all();     //todos los roles
        
        //retorna todos los roles menos los que ya tiene el usuario
        return $allRoles->diff($actualRoles);
    }
    
    //método que recupera el rol de un usuario
    public function hasRole($roleNames):bool{
        
        //si solamente viene un rol, lo mete en un array
        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }
        
        
        //recorre la lista de roles buscando
        foreach ($this->roles as $role){
            
            if (in_array($role->rol, $roleNames)) {
                return true; // si lo encuentra
            }
        }
        
        return false; //si no lo encuentra
    }
    
    //método para saber si un usuario es propietario de un anuncio
    public function isOwner(Anuncio $anuncio):bool{
        return $this->id == $anuncio->user_id;
    }
    
    //método para saber si un usuario es propietario de una oferta
    public function isPropietario(Oferta $oferta):bool{
        return $this->id == $oferta->user_id;
    }
}
