<?php

namespace App\Policies;

use App\Models\Anuncio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnuncioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //es público entonces no hace falta
    }
    
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Anuncio $anuncio)
    {
        //es público entonces no hace falta
    }
    
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //ya está limitado por el middleware auth
    }
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Anuncio $anuncio)
    {
        return $user->isOwner($anuncio) || $user->hasRole(['administrador', 'editor']);
    }
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Anuncio $anuncio)
    {
        return $user->isOwner($anuncio) || $user->hasRole(['administrador', 'editor']);
    }
    
    /**
     * Determine whether the user can remove the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function remove(User $user, Anuncio $anuncio)
    {
        return $user->isOwner($anuncio) || $user->hasRole(['administrador', 'editor']);
    }
    
    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Anuncio $anuncio)
    {
        //permisos para restaurar anuncios
        return $user->isOwner($anuncio) || $user->hasRole(['administrador', 'editor']);
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Anuncio $anuncio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Anuncio $anuncio)
    {
        //
    }
}
