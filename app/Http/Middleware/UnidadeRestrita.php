<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Requerente;

class UnidadeRestrita
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Recupera os parâmetros vindo na URL, nesse caso, só o parâmetro "requerente" virá via URL
        // O parâmetro que vem via URL é um único objeto "requerente" com todas as suas propriedades 
        // dd($request->route()->parameters());
        
        // Verifica a existência do parâmetro(requerente) na URL e em caso positivo atribui seus parâmetros, que é um array, à variável
        // $dadosRequerente irá receber um array com todos os parâmetros vindo na URL. nesse caso o único parâmetro será o array 'requerente'
        $dadosRequerente = !is_null($request->route('requerente')) ? $request->route()->parameters() : NULL;

        $idRequerente = $dadosRequerente['requerente']['id'];
        $idUnidAtendimentoRequerente = $dadosRequerente['requerente']['unidadeatendimento_id'];

        // Se o usuário autenticado não é Administrador, é porque é um usuário Assistente Social. Neste caso, verifica
        // se o requerente que ele deseja acessa via URL pertence a sua Unidade de Atendimento. O administrador acessa
        // qualquer requerente independente da unidade de atendimento em que o mesmo foi cadastrado.
        if(Auth::user()->perfil != "adm"){

            // Verifica se a Unidade de Atendimento do Usuário é a mesma Unidade de Atendimento da Requerente
            if (Auth::user()->unidadeatendimento_id != $idUnidAtendimentoRequerente) {
                // Deslogar o usuário
                Auth::logout();
                
                // Redireciona o usuário enviando a mensagem de aviso
                return redirect()->route('login.index')->with('warning', 'Operação ilegal!');
            }
            
        }

        return $next($request);
    }
}
