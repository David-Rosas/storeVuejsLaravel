<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{
 
    public function index(Request $request)
    {
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
            $proveedores = Proveedor::orderBy('id', 'desc')->paginate(3);
        }else{                
            $proveedores = Proveedor::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $proveedores->total(),
             'current_page'  => $proveedores->currentPage(),
             'per_page'      => $proveedores->perPage(),
             'last_page'     => $proveedores->lastPage(),
             'from'          => $proveedores->firstItem(),
             'to'            => $proveedores->lastItem(),
            ],
        'proveedores' => $proveedores      
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
       //segurity request only ajax
       if(!$request->ajax()) return redirect('/');

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->tipo_documento = $request->tipo_documento;
        $proveedor->num_documento = $request->num_documento;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
    }   

    public function update(Request $request)
    {
       //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //return $request;
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->nombre = $request->nombre;
        $proveedor->tipo_documento = $request->tipo_documento;
        $proveedor->num_documento = $request->num_documento;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        
        
    }
}
