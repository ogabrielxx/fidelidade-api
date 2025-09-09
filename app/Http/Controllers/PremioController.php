<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResgatarPremioClienteRequest;
use App\Mail\ResgatePremioMail;
use App\Models\Cliente;
use App\Models\Premio;
use App\Models\Resgate;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PremioController extends Controller
{
    public function resgatar(ResgatarPremioClienteRequest $request){
        try {
            $data = $request->validated();
            $identificadorPremio = $data["premio"];
            $identificadorCliente = $request->cliente;

            $cliente = Cliente::find($identificadorCliente);

            if(!$cliente){
                return response()->json(["message"=> "Cliente não encontrado!"],404);
            }

            $premio = Premio::find($identificadorPremio);

            if(!$premio){
                return response()->json(["message"=> "Prêmio não encontrado!"],404);
            }

            $pontosCliente = $cliente->saldo_pontos;
            $pontosUsados = $premio->valor_pontos;

            $saldoFinalCliente = $pontosCliente - $pontosUsados;

            if($saldoFinalCliente <= 0){
                return response()->json(["message"=> "Saldo insuficiente"],403);
            }

            DB::transaction(function () use ($cliente, $premio) {
                Resgate::create([
                    'data' => now()->toDateString(),
                    'cliente' => $cliente->id,
                    'premio' => $premio->id,
                    'valor_pontos' => $premio->valor_pontos,
                ]);

                $cliente->decrement('saldo_pontos', $premio->valor_pontos);
            });

            Mail::to($cliente->email, $cliente->nome)->queue((new ResgatePremioMail($premio->nome))->onQueue('resgate'));

            $retorno = [
                "cliente" => $cliente->id,
                "saldo_pontos_cliente" => $pontosCliente - $pontosUsados,
                "premio_resgatado" => $premio->nome,
                "valor_premio_resgatado" => $pontosUsados
            ];

            return response()->json($retorno, 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao consultar saldo do cliente!"], 500);
        }
    }
}
