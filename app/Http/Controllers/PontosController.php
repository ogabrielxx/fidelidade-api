<?php

namespace App\Http\Controllers;

use App\Http\Requests\PontuarClienteRequest;
use App\Mail\PontuarClienteMail;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PontosController extends Controller
{
    public function saldo(Request $request){
        try {
            $identificadorCliente = $request->cliente;

            $cliente = Cliente::with('resgates')
                ->select('id', 'nome', 'saldo_pontos')
                ->find($identificadorCliente);

            if(!$cliente){
                return response()->json(["message"=> "Cliente não encontrado!"],404);
            }

            return response()->json($cliente, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao consultar saldo do cliente!"], 500);
        }
    }

    public function pontuar(PontuarClienteRequest $request){
        try {
            $data = $request->validated();
            $valorGasto = $data["valor_gasto"];
            $identificadorCliente = $request->cliente;

            if($valorGasto < 5){
                return response()->json(["message"=> "O valor gasto não atingiu o mínimo necessário para pontuar"],403);
            }

            $cliente = Cliente::find($identificadorCliente);

            if(!$cliente){
                return response()->json(["message"=> "Cliente não encontrado!"],404);
            }

            $pontos = calcularPontos($valorGasto);

            $novoSaldo = $cliente->saldo_pontos + $pontos;

            $cliente->update([
                "saldo_pontos" => $cliente->saldo_pontos + $pontos
            ]);

            Mail::to($cliente->email, $cliente->nome)->queue((new PontuarClienteMail($novoSaldo))->onQueue('pontuar'));

            $retorno = ["saldo_pontos" => $cliente->saldo_pontos];

            return response()->json($retorno, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao consultar saldo do cliente!"], 500);
        }
    }
}
