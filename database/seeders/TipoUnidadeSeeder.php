<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipounidade;

class TipoUnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipounidade = new Tipounidade();
            $tipounidade->nome = "SEMU";
            $tipounidade->descricao = "SECRETARIA DE ESTADO DA MULHER";
            $tipounidade->ativo = true;
        $tipounidade->save();
    }
}
