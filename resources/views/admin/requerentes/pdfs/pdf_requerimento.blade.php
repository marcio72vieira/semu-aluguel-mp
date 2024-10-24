<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEDES - requerente</title>
</head>


<body>
    <table style="width: 717px; border-collapse: collapse; margin-bottom: 15px;">
        <tr>
            <td style="width: 717px; text-align: center; font-size: 10px; font-family: Arial, Helvetica, sans-serif;">
                <br>
                ANEXO I
                <br>
                FORMULÁRIO PARA REQUERIMENTO DO "ALUGUEL MARIA DA PENHA"
            </td>
        </tr>
    </table>

    {{-- IFNROMAÇÕES DA REQUERENTE --}}
    <table style="width: 717px; border-collapse: collapse;">
        <tr>
            <td colspan="4" style="width: 717px; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-style: italic; font-weight: bold;">
                INFORMAÇÕES DA REQUERENTE
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 317px;" class="label-ficha">Nome Completo</td>
            <td style="width: 100px;" class="label-ficha">Sexo Biológico</td>
            <td style="width: 200px;" class="label-ficha">RG - Órgão Expedidor</td>
            <td style="width: 100px;" class="label-ficha">CPF</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->nomecompleto }}</td>
            <td style="width: 100px;" class="dados-ficha">{{ $requerente->sexobiologico }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->rg }} {{ $requerente->orgaoexpedidor }}</td>
            <td style="width: 100px;" class="dados-ficha">{{ $requerente->cpf }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 317px;" class="label-ficha">Banco</td>
            <td style="width: 100px;" class="label-ficha">Agência</td>
            <td style="width: 200px;" class="label-ficha">Conta</td>
            <td style="width: 100px;" class="label-ficha">OBS:</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->banco }}</td>
            <td style="width: 100px;" class="dados-ficha">{{ $requerente->agencia }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->conta }}</td>
            <td style="width: 100px;" class="dados-ficha">{{ $requerente->contaespecifica == "1" ? "conta específica" : "sem movimentação" }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 158px;" class="label-ficha">Comunidade específica/tradicional</td>
            <td style="width: 159px;" class="label-ficha">Cor/raça</td>
            <td style="width: 200px;" class="label-ficha">dentidade de Gênero</td>
            <td style="width: 200px;" class="label-ficha">Orientação Sexual</td>
        </tr>
        <tr>
            <td style="width: 158px;" class="dados-ficha">{{ $requerente->comunidade == "20" ? $requerente->outracomunidade : $arr_comunidade[$requerente->comunidade] }}</td>
            <td style="width: 159px;" class="dados-ficha">{{ $requerente->racacor  == "20" ? $requerente->outraracacor : $arr_racacor[$requerente->racacor] }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->identidadegenero  == "20" ? $requerente->outraidentidadegenero : $arr_comunidade[$requerente->identidadegenero] }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->orientacaosexual  == "20" ? $requerente->outraorientacaosexual : $arr_comunidade[$requerente->orientacaosexual] }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 717px;" class="label-ficha">Pessoa com deficiência?</td>
        </tr>
        <tr>
            <td style="width: 717px;" class="dados-ficha">{{ $requerente->deficiente == "1" ? $requerente->deficiencia : "Não" }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 317px;" class="label-ficha">Endereço</td>
            <td style="width: 70px;" class="label-ficha">nº</td>
            <td style="width: 330px;" class="label-ficha">Complemento</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->endereco }}</td>
            <td style="width: 70px;" class="dados-ficha">{{ $requerente->numero }}</td>
            <td style="width: 330px;" class="dados-ficha">{{ $requerente->complemento }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 317px;" class="label-ficha">Bairro</td>
            <td style="width: 70px;" class="label-ficha">CEP</td>
            <td style="width: 330px;" class="label-ficha">Cidade</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->bairro }}</td>
            <td style="width: 70px;" class="dados-ficha">{{ $requerente->cep }}</td>
            <td style="width: 330px;" class="dados-ficha">{{ $requerente->municipio->nome }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse; margin-bottom: 30px">
        <tr>
            <td style="width: 158px;" class="label-ficha">Telefone Residencial</td>
            <td style="width: 159px;" class="label-ficha">Telefone Celular</td>
            <td style="width: 400px;" class="label-ficha">E-mail</td>
        </tr>
        <tr>
            <td style="width: 158px;" class="dados-ficha">{{ $requerente->foneresidencial }}</td>
            <td style="width: 159px;" class="dados-ficha">{{ $requerente->fonecelular }}</td>
            <td style="width: 400px;" class="dados-ficha">{{ $requerente->email }}</td>
        </tr>
        <tr>
            <td colspan="3" style="width:717px;" class="close-ficha"></td>
        </tr>
    </table>

    {{-- DETALHAMENTO DO REQUERIMENTO --}}
    <table style="width: 717px; border-collapse: collapse;">
        <tr>
            <td colspan="4" style="width: 717px; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-style: italic; font-weight: bold;">
                DETALHAMENTO DO REQUERIMENTO
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 317px;" class="label-ficha">Processo Judicial em que foi concedida a medida protetiva</td>
            <td style="width: 200px;" class="label-ficha">Órgão Judiciário</td>
            <td style="width: 200px;" class="label-ficha">Comarca</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->nomecompleto }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->sexobiologico }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->rg }} {{ $requerente->orgaoexpedidor }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse;">
        <tr>
            <td style="width: 317px;" class="label-ficha">Prazo da medida protetiva</td>
            <td style="width: 400px;" class="label-ficha">Data em que concedida</td>
        </tr>
        <tr>
            <td style="width: 317px;" class="dados-ficha">{{ mrc_turn_data($requerente->detalhe->prazomedidaprotetiva) }}</td>
            <td style="width: 400px;" class="dados-ficha">{{ mrc_turn_data($requerente->detalhe->dataconcessaomedidaprotetiva) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="width:717px;" class="close-ficha"></td>
        </tr>
    </table>

</body>
</html>

