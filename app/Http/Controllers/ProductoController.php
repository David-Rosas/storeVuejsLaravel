<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //segurity request only ajax
       if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
            $productos = Producto::join('categorias', 'productos.idcategoria', '=', 'categorias.id')
            ->select('productos.id', 'productos.idcategoria', 'productos.codigo', 'productos.nombre', 'categorias.nombre as nombre_categoria', 'productos.precio_venta', 'productos.stock', 'productos.condicion')
            ->orderBy('id', 'desc')->paginate(3);
        }else{                
            $productos = Producto::join('categorias', 'productos.idcategoria', '=', 'categorias.id')
            ->select('productos.id', 'productos.idcategoria', 'productos.codigo', 'productos.nombre', 'categorias.nombre as nombre_categoria', 'productos.precio_venta', 'productos.stock', 'productos.condicion')
            ->where('productos.'.$criterio, 'like', '%'.$buscar.'%')
            ->orderBy('productos.id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $productos->total(),
             'current_page'  => $productos->currentPage(),
             'per_page'      => $productos->perPage(),
             'last_page'     => $productos->lastPage(),
             'from'          => $productos->firstItem(),
             'to'            => $productos->lastItem(),
            ],
        'productos' => $productos      
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

        $producto = new Producto();
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->condicion = '1';
        $producto->save();
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //return $request;
        $producto = Producto::findOrFail($request->id);
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->condicion = '1';
        $producto->save();
        
        
    }

    public function desactivar(Request $request)
    {  
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');

        $producto = Producto::findOrFail($request->id);        
        $producto->condicion = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
       //segurity request only ajax
       if(!$request->ajax()) return redirect('/');

        $producto = Producto::findOrFail($request->id);        
        $producto->condicion = '1';
        $producto->save();
    }
}
