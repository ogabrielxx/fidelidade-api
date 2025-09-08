<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PontosController;
use App\Http\Controllers\PremioController;

// Grupo com middleware de autenticação via token com permissões que permite até 60 requisições no espaço de 1 minuto
Route::middleware(['auth.token', 'throttle:60,1'])->group(function () {

    // 001 - Cadastrar cliente
    Route::post('/clientes', [ClienteController::class, 'store'])->middleware('auth.token:001');

    // 002 - Buscar cliente por ID ou outro identificador
    Route::get('/clientes/{identificador}', [ClienteController::class, 'show'])->middleware('auth.token:002');

    // 003 - Listar todos os clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->middleware('auth.token:003');

    // 004 - Buscar saldo de pontos + prêmios resgatados
    Route::get('/clientes/{cliente}/saldo', [PontosController::class, 'saldo'])->middleware('auth.token:004');

    // 005 - Resgatar prêmio
    Route::post('/clientes/{cliente}/resgates', [PremioController::class, 'resgatar'])->middleware('auth.token:005');

    // 006 - Pontuar cliente (valor gasto)
    Route::post('/clientes/{cliente}/pontuar', [PontosController::class, 'pontuar'])->middleware('auth.token:006');

});
