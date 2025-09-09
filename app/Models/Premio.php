<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Premio extends Model
{
    use SoftDeletes;

    protected $table = "premios";

    protected $fillable = [
        "nome",
        "valor_pontos"
    ];
}
