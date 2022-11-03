<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{    
    //muestra los usuarios bloqueados
    public function lockedUsers(Request $request){
        
        //recuperar los usuarios bloqueados
        $lockedUsers = $request->user()->hasRole('bloqueado')
            ->get()->paginate(config('pagination.users', 10));
        
        //cargar la vista de usuarios bloqueados pasándole los usuarios
        return view('admin.users.locked', ['lockedUsers' => $lockedUsers]);
    }
    
    //muestra la lista de usuarios
    public function userList(){
        $users = User::orderBy('name', 'ASC')->paginate(config('pagination.users', 10));
        
        return view('admin.users.list', ['users' => $users]);
    }
    
    //muestra un usuario
    public function userShow(User $user){
        
        //carga la vista de detalles y le pasa el usuario recuperado
        return view('admin.users.show', ['user' => $user]);
    }
    
    //método que busca usuarios
    public function userSearch(Request $request){
        $request->validate(['name' => 'max:32', 'email' => 'max:32']);
        
        //toma los valores que llegan para nombre y email y rol
        $name = $request->input('name','');
        $email = $request->input('email','');
        
        //recupera los resultados, añadimos nombre y email al paginator
        //para que haga bien los enlaces y se mantenga el filtro al pasar de página
        $users = User::orderBy('name', 'ASC')
            ->where('name','like',"%$name%")
            ->where('email','like',"%$email%")
            ->paginate(config('pagination.users'))
            ->appends(['name' => $name, 'email' => $email]);
        
        //retorna la vista de lista con el filtro aplicado
            return view('admin.users.list', ['users' => $users, 'name'=>$name, 'email'=>$email]);
    }
    
    //añade un rol a un usuario
    public function setRol(Request $request){
        $rol = Role::find($request->input('role_id'));
        $user = User::find($request->input('role_id'));
        
        //intenta añadir el rol
        try {
            $user->roles()->attach($rol->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            //eliminar anuncios y ofertas del usuario bloqueado
            if ($rol->rol == 'bloqueado') {
                $user->anuncios()->delete();
                $user->ofertas()->delete();
            }
            
            return back()->with('success', "Rol $rol->rol añadido a $user->name correctamente.");
            
        //si no lo consigue... (use Illuminate\Database\QueryException)
        } catch (QueryException $e) {
            return back()->withErrors("No se pudo añadir el rol $rol->rol a $user->name.
                                        Es posible que ya lo tenga.");
        }
    }
    
    //quita un rol a un usuario
    public function removeRol(Request $request){
        $rol = Role::find($request->input('role_id'));
        $user = User::find($request->input('role_id'));
        
        //intenta quitar el rol
        try {
            $user->roles()->detach($rol->id);
            return back()->with('success', "Rol $rol->rol quitado a $user->name correctamente.");
            
        //si no lo consigue...
        } catch (QueryException $e) {
            return back()->withErrors("No se pudo quitar el rol $rol->rol a $user->name.");
        }
    }
}
