<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = "clientes";

    protected $fillable = [
        "nome",
        "email",
        "cpf",
        "saldo_pontos",
        "valor_remanescente"
    ];

    public function resgates(): HasMany
    {
        return $this->hasMany(Resgate::class, "cliente", "id");
    }
}
