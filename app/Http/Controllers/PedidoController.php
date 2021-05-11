<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function show($id = null)
    {
        if ($id) {
            $pedidos = \App\Models\Pedido::find($id);
        }else{
            $pedidos = \App\Models\Pedido::all();
        }
        return response($pedidos, 200, [
            'Content-type' => 'application/json'
        ]);

        dd($pedidos);
    }

    public function create(Request $request)
    {
        if(isset($request->mesa)){
            $pedido = new \App\Models\Pedido();
            $pedido->mesa = $request->mesa;
            $pedido->lanche = $request->lanche;
            $pedido->obs = $request->obs;
            $pedido->acompanhamento = $request->acompanhamento;
            $pedido->bebida = $request->bebida;
            $pedido->status = $request->status;
            $pedido->save();
            return response($pedido,201,[
                'Content-type' => 'application/json'
            ]);
        }
        return response([
            'error' => 'Erro!'
        ], 404, [
            'Content-type' => 'application/json'
        ]);
    }
    
    public function finaliza(Request $requet,$id)
    {   
        if(isset($id)){
            $pedido = \App\Models\Pedido::find($id);
            $pedido->status = 'Finalizado';
            $pedido->save();
            return response($pedido,201,[
                'Content-type' => 'application/json'
            ]);
        }
    }

    
}