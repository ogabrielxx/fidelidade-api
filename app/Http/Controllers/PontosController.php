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

            $pontos = calcularPontos($valorGasto)["pontos"];
            $novoSaldo = $cliente->saldo_pontos + $pontos;

            $valorRemanescente = calcularPontos($valorGasto)["valor_remanescente"];

            $valorRemanescenteCliente = $cliente->valor_remanescente;

            $valorRemanescenteTotal = $valorRemanescente + $valorRemanescenteCliente;

            // Se o valor remanescente total for maior ou igual a cinco adiciona mais um ponto ao saldo e salva o (valor remanescente - 5 (1 ponto)) no campo de valor_remanescente
            if($valorRemanescenteTotal >= 5){
                $novoSaldo++;
                $valorRemanescenteTransacaoAtual = $valorRemanescenteTotal - 5;
            }else{
                $valorRemanescenteTransacaoAtual = $valorRemanescenteTotal;
            }

            $cliente->update([
                "saldo_pontos" => $novoSaldo,
                "valor_remanescente" => $valorRemanescenteTransacaoAtual
            ]);

            Mail::to($cliente->email, $cliente->nome)->queue((new PontuarClienteMail($novoSaldo))->onQueue('pontuar'));

            $retorno = ["saldo_pontos" => $cliente->saldo_pontos];

            return response()->json($retorno, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao consultar saldo do cliente!"], 500);
        }
    }
}
