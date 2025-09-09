<?php

namespace Database\Seeders;

use App\Models\Premio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PremiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premios = [
            ['nome' => 'Suco de Laranja', 'valor_pontos' => 5],
            ['nome' => '10% de desconto', 'valor_pontos' => 10],
            ['nome' => 'Almoço especial', 'valor_pontos' => 20],
        ];

        foreach ($premios as $premio) {
            Premio::updateOrCreate(
                ['nome' => $premio['nome']],
                ['valor_pontos' => $premio['valor_pontos']]
            );
        }
    }
}
