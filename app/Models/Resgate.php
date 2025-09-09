<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resgate extends Model
{
    use SoftDeletes;

    protected $table = "resgates";

    protected $fillable = [
        "data",
        "cliente",
        "premio",
        "valor_pontos"
    ];
}
