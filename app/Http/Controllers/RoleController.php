<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
            $roles = Role::orderBy('id', 'desc')->paginate(3);
        }else{                
            $roles = Role::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $roles->total(),
             'current_page'  => $roles->currentPage(),
             'per_page'      => $roles->perPage(),
             'last_page'     => $roles->lastPage(),
             'from'          => $roles->firstItem(),
             'to'            => $roles->lastItem(),
            ],
        'roles' => $roles      
        ];
        
    }
}
