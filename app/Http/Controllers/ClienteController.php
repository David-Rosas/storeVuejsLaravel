<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        //segurity request only ajax
      //  if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
            $clientes = Cliente::orderBy('id', 'desc')->paginate(3);
        }else{                
            $clientes= Cliente::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $clientes->total(),
             'current_page'  => $clientes->currentPage(),
             'per_page'      => $clientes->perPage(),
             'last_page'     => $clientes->lastPage(),
             'from'          => $clientes->firstItem(),
             'to'            => $clientes->lastItem(),
            ],
        'clientes' => $clientes      
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

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->num_documento = $request->num_documento;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();
    }   

    public function update(Request $request)
    {
       //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //return $request;
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->num_documento = $request->num_documento;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        
        
    }
}
