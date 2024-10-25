<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEDES - requerente</title>
</head>


<body>
    {{-- ANEXO I--}}
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
            <td colspan="3" style="width: 717px; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-style: italic; font-weight: bold;">
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
            <td style="width: 317px;" class="dados-ficha">{{ $requerente->detalhe->processojudicial }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->detalhe->orgaojudicial }}</td>
            <td style="width: 200px;" class="dados-ficha">{{ $requerente->detalhe->comarca }}</td>
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

    <table  style="width: 717px; border-collapse: collapse; margin-bottom: 30px">
        <tr>
            <td style="width: 687px;" class="dados-normal"> A requerente foi atendida com a medida protetiva de urgência de encaminhamento a programa oficial ou
                comunitário de proteção ou atendimento? (art. 23, I, Lei 11.340/2006)*
            </td>
            <td style="width: 30px; text-allign: center" class="dados-normal">{{ $requerente->detalhe->medproturgcaminhaprogoficial == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal"> A requerente foi atendida com a medida protetiva de urgência de afastamento do lar?  (art. 23, III, Lei
                11.340/2006)*
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->medproturgafastamentolar == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal"> A requerente encontra-se em situação de risco de vida iminente em razão de violência doméstica, carecendo de
                moradia protegida em caráter sigiloso?
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->riscmortvioldomesmoradprotegsigilosa == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal"> A requerente encontra-se em situação de risco de morte, aguardando medida protetiva de urgência? </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->riscvidaaguardmedproturg == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente encontra-se em situação de risco de morte e relata descumprimento de medida protetiva de
                urgência pelo agressor, necessitando de proteção até que se efetive a prisão deste?
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->relatodescomprmedproturgagressor == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente está em situação de vulnerabilidade, de forma a não conseguir arcar com as despesas de moradia?*</td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->sitvulnerabnaoconsegarcardespmoradia == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente tem renda familiar de no máximo 02 salários, mesmo durante o convívio com o agressor?* </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->temrendfamiliardoissalconvivagressor == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente não possui pais, avós, filhos ou netos maiores de idade, no mesmo município de sua residência?* Se sim, quais
                @if ($requerente->detalhe->paiavofilhonetomaiormesmomunicipresid == "1")
                    <br>
                    <strong>{{ $requerente->detalhe->parentesmesmomunicipioresidencia }}</strong>
                @endif
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->paiavofilhonetomaiormesmomunicipresid == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente possui filhos menores de idade?</td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->filhosmenoresidade == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente está trabalhando ou possui alguma forma de gerar renda no momento? Se sim, valor

                @if ($requerente->detalhe->trabalhaougerarenda == "1")
                    <br>
                    <strong>R$ {{ mrc_turn_value($requerente->detalhe->valortrabalhorenda) }}</strong>
                @endif
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->trabalhaougerarenda == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente está cadastrada no Cadastro Único (CADÚNICO)?*</td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->temcadunico == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente tem interesse de participar de formações para qualificação profissional e de desenvolvimento de
                habilidades (cursos, oficinas, entre outros)?
            </td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->teminteresformprofisdesenvolvhabilid == "1" ? "sim" : "não" }}</td>
        </tr>
        <tr>
            <td style="width: 687px;" class="dados-normal">requerente apresentou documento de identificação?</td>
            <td style="width: 30px;" class="dados-normal">{{ $requerente->detalhe->apresentoudocumentoidentificacao == "1" ? "sim" : "não" }}</td>
        </tr>
    </table>

    <table  style="width: 717px; border-collapse: collapse; margin-bottom: 90px;">
        <tr>
            <td style="width: 687px;" class="dados-normal">A requerente cumpre os requisitos previstos nos itens marcados com (*), necessários para concessão do benefício?
            </td>
            <td style="width: 30px; text-allign: center" class="dados-normal">{{ $requerente->detalhe->cumprerequisitositensnecessarios == "1" ? "sim" : "não" }}</td>
        </tr>
    </table>

    {{-- DECLARAÇÕES --}}
    <table style="width: 717px; border-collapse: collapse; margin-bottom: 150px;">
        <tr>
            <td colspan="4" style="width: 717px; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-style: italic; font-weight: bold;">
                DECLARAÇÕES
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 717px; text-align:justify" class="dados-declaracao">
                <br>
                <br>
                A requerente declara ter ciência de que o benefício será concedido no valor de R$ 600,00 (seiscentos reais) pelo que perdurar a medida
                protetiva, limitado a ATÉ 12 (doze) meses, podendo ser suspenso a qualquer tempo acaso volte a conviver com o agressor, cesse a medida
                protetiva de urgência, cesse a situação de vulnerabilidade, ou perceba renda superior a 02 (dois) salários mínimos, conforme art. 8º, do
                Decreto Estadual nº 36.340, de 03 de novembro de 2020.

                <br>
                <br>

                A requerente declara estar ciente de que o benefício deverá ser usado exclusivamente para custear despesas com moradia ou hospedagem em hotéis,
                pensões e similares, também podendo ser custeadas despesas decorrentes da habitação tais como tarifas de luz, água, taxas de condomínio e IPTU,
                conforme art. 9º, caput e §1º, do Decreto Estadual nº 36.340, de 03 de novembro de 2020.

                <br>
                <br>

                A requerente declara estar ciente de que é proibido o uso do “Aluguel Maria da Penha” para fins diversos do previsto no item 3.2, ensejando o
                descumprimento a aplicação de multa de até 10 (dez) vezes o valor do benefício, sem prejuízo das sanções civis e penais cabíveis, de acordo com
                o art. 6º, da Lei Estadual nº 11.350, de 02 de outubro de 2020.


                <br>
                <br>

                A requerente declara estar ciente de que após o recebimento do primeiro aluguel, deverá apresentar o contrato de locação ou documento
                similar para fins de prova da locação, sob pena de suspensão do benefício, conforme art. 9º, §3º, do Decreto Estadual nº 36.340, de 03
                de novembro de 2020.

                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 717px; text-align:center" class="dados-lista">
                <br><br><br><br><br><br>
                Data e assinatura da requerente
                <br><br><br>
                ________________________________________________________
                <br><br><br><br><br><br>
                ____________________________________,_________ de _________________________ de ____________
                <br><br>
                Município                   dia/mês/ano
            </td>
        </tr>
    </table>

    {{-- UNIDADE RESPONSÁVEL PELO ENCAMINHAMENTO --}}
    <table style="width: 717px; border-collapse: collapse;  margin-bottom: 10px;">
        <tr>
            <td colspan="4" style="width: 717px; font-size: 10px; font-family: Arial, Helvetica, sans-serif; font-style: italic; font-weight: bold;">
                UNIDADE RESPONSÁVEL PELO ENCAMINHAMENTO
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 717px; text-align:justify" class="dados-lista">
                Secretaria de Estado da Mulher, Casas da Mulher, Defensoria Pública do Estado, Organismos Municipais de Política para as Mulheres – OPM's,
                Centro de Referência Especializada da Assistência Social – CREAS e Centro de Referência da Assistência Social – CRAS.
                <br><br>
            </td>
        </tr>
        <tr>
            <td style="width: 500px;" class="label-ficha">Órgão</td>
            <td style="width: 217px;" class="label-ficha">Data do encaminhamento</td>
        </tr>
        <tr>
            <td style="width: 500px;" class="dados-ficha">{{ $requerente->unidadeatendimento->nome }}</td>
            <td style="width: 217px;" class="dados-ficha">{{  \Carbon\Carbon::now()->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="width:717px;" class="close-ficha"></td>
        </tr>
        <tr>
            <td colspan="2" style="width: 717px; text-align:center" class="dados-lista">
                <br>
                <br>
                <br>
                _____________________________________________
                <br>
                CPF nº {{ $requerente->user->cpf }}
                <br><br>
                Assinatura e carimbo do profissional responsável
            </td>
        </tr>
    </table>

    {{-- ANEXO I--}}
    <table style="width: 717px; border-collapse: collapse; margin-bottom: 15px;">
        <tr>
            <td style="width: 717px; text-align: center; font-size: 10px; font-family: Arial, Helvetica, sans-serif;">
                <br>
                ANEXO II
                <br>
                DECLARAÇÃO DE VULNERABILIDADE SOCIOECONÔMICA
            </td>
        </tr>
    </table>

    <table style="width: 717px; border-collapse: collapse; margin-bottom: 300px;">
        <tr>
            <td style="width: 717px; text-align:justify" class="dados-declaracao">
                <br>
                <br>
                <span style="color: white">.................</span>Eu <strong>{{ $requerente->nomecompleto}}</strong>, portadora do  RG nº <strong>{{ $requerente->rg }} {{ $requerente->orgaoexpedidor }}</strong> e
                do  CPF nº <strong>{{ $requerente->cpf }}</strong>, declaro para todos os fins de direito e sob as penas da lei, <strong>que me encontro em situação de vulnerabilidade</strong>,
                nos termos do art. 2º, II, da Lei Estadual nº 11.350, de 02 de outubro de 2020, referente ao Programa Social “Aluguel Maria da Penha”, compreendida no conceito de situação de pobreza,
                privação de renda e/ ou acesso a serviços públicos, fragilização de vínculos afetivos, relacionais ou de pertencimento social
                (discriminações etárias, étnicas, de gênero, por deficiências, etc.).Em consequência disso, declaro, ainda, <strong>que não possuo condições de arcar com despesas de moradia</strong>,
                nos termos do art. 2º, II e III, da Lei Estadual nº 11.350, de 02 de outubro de 2020.Por fim, é de meu conhecimento que a falsidade das afirmações supracitadas ensejará a
                aplicação das penalidades previstas no art. 299 do Código Penal, como também a suspensão do “Aluguel Maria da Penha”, conforme art. 3º, §1º, da aludida norma estadual.
            </td>
        </tr>
        <tr>
            <td style="width: 717px; text-align:center" class="dados-lista">
                <br><br><br><br><br><br>
                ____________________________________,_________ de _________________________ de ____________
                <br><br>
                Cidade                   dia/mês/ano
                <br><br><br><br><br><br>

                ________________________________________________________
                <br>
                Assinatura da interessada
                <br><br><br>
            </td>
        </tr>
    </table>

</body>
</html>

