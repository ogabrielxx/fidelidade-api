<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteRequest;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function store(CreateClienteRequest $request){
        try {
            $data = $request->validated();

            // Define o saldo de pontos inicial do cliente como zero
            $data["saldo_pontos"] = 0;

            $cliente = Cliente::create($data);

            return response()->json($cliente, 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao salvar o cliente!"], 500);
        }
    }

    public function show(Request $request){
        try {
            $identificador = $request->identificador;

            $cliente = Cliente::find($identificador);

            if(!$cliente){
                return response()->json(["message"=> "Cliente não encontrado!"],404);
            }

            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao buscar o cliente!"], 500);
        }
    }

    public function index(){
        try {
            $clientes = Cliente::get();

            if(empty($clientes)){
                return response()->json(["message"=> "Nenhum cliente cadastrado!"],404);
            }

            return response()->json($clientes, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao buscar os clientes!"], 500);
        }
    }
}
