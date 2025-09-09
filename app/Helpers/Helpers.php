<?php

function calcularPontos($valorGasto)
{
    return [
        "pontos" => (int) floor($valorGasto / 5),
        "valor_remanescente" => fmod($valorGasto, 5)
    ];
}
