<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidadeatendimento;

class UnidadeAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidadeatendimento = new Unidadeatendimento();
            $unidadeatendimento->tipounidade_id = 1;
            $unidadeatendimento->nome = "Secreataria de Estado da Mulher";
            $unidadeatendimento->endereco =  "Rua tal de tal";
            $unidadeatendimento->numero = "s/n";
            $unidadeatendimento->complemento =  "";
            $unidadeatendimento->bairro ="Centro";
            $unidadeatendimento->cep = "65000-000";
            $unidadeatendimento->fone = "(98) 99999-9999";
            $unidadeatendimento->regional_id = 1;
            $unidadeatendimento->municipio_id = 1;
            $unidadeatendimento->ativo =  true;
        $unidadeatendimento->save();
    }
}
