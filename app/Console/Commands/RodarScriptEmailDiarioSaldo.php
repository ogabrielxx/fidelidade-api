<?php

namespace App\Console\Commands;

use App\Mail\EmailDiarioSaldoMail;
use App\Models\Cliente;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RodarScriptEmailDiarioSaldo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar:emailDiarioSaldo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia e-mail todos os dias para todos os clientes que tem saldo disponível de pontos para resgatar o prêmio máximo';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $clientesComSaldo = Cliente::where('saldo_pontos', '>=', 20)->get();

        foreach ($clientesComSaldo as $cliente) {
            Mail::to($cliente->email, $cliente->nome)->queue((new EmailDiarioSaldoMail($cliente->saldo_pontos))->onQueue('diario'));
        }
    }
}
