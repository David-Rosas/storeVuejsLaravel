<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //segurity request only ajax
      // if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
           $usuarios = User::join('roles', 'users.idrol', '=', 'roles.id')
           ->select('users.id', 'users.nombre', 'users.tipo_documento', 
           'users.num_documento', 'users.direccion', 'users.telefono',
           'users.email', 'users.usuario', 'users.password',
           'users.condicion', 'users.idrol', 'roles.nombre as rol')
           ->orderBy('id', 'desc')->paginate(3);
        }else{                
            $usuarios = User::join('roles', 'users.idrol', '=', 'roles.id')
            ->select('users.id', 'users.nombre', 'users.tipo_documento', 
            'users.num_documento', 'users.direccion', 'users.telefono',
            'users.email', 'users.usuario', 'users.password',
            'users.condicion', 'users.idrol', 'roles.nombre as rol')
            ->where('users.'.$criterio, 'like', '%'. $buscar .'%')
            ->orderBy('id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $usuarios->total(),
             'current_page'  => $usuarios->currentPage(),
             'per_page'      => $usuarios->perPage(),
             'last_page'     => $usuarios->lastPage(),
             'from'          => $usuarios->firstItem(),
             'to'            => $usuarios->lastItem(),
            ],
        'usuarios' => $usuarios      
        ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //return $request;
       //segurity request only ajax
     //  if(!$request->ajax()) return redirect('/');

        $user = new User();
        $user->nombre = $request->nombre;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->condicion = '1';
        $user->idrol = $request->idrol;
        $user->save();
    }   

    public function update(Request $request)
    {
       //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //return $request;
        $user  = User::findOrFail($request->id);
        $user->nombre = $request->nombre;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->condicion = '1';
        $user->idrol = $request->idrol;
        $user->save();
    }   
    public function desactivar(Request $request)
    {  
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);        
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
       //segurity request only ajax
       if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);        
        $user->condicion = '1';
        $user->save();
    }  
        
    
}
