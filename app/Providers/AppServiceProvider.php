<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{

    protected $policies = [];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Incluir a paginação do Bootstrap 5
        Paginator::useBootstrapFive();


        // Define o acesso apenas de quem é Administrdor
        Gate::define('onlyAdm', function($user) {
            return $user->perfil == 'adm'
                ? Response::allow()
                : Response::deny('Acesso não autorizado!');
        });
        
         
        // Define o acesso apenas de quem é Administrador ou Servidor
        Gate::define('onlyAdmSrv', function($user) {
            return $user->perfil == 'adm' || $user->perfil == 'srv' 
                ? Response::allow()
                : Response::deny('Acesso não autorizado!');
        });


        // Define o acesso apenas de quem é Administrador ou Assistente Social.
        Gate::define('onlyAdmAss', function($user) {
            return $user->perfil == 'adm' || $user->perfil == 'ass'
                ? Response::allow()
                : Response::deny('Acesso não autorizado!');
        });

        
          
    }
}
