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


         
         /* define os papeis para os Usuários: admin, servidor e assistente role */
         Gate::define('adm', function($user) {
             return $user->perfil == 'adm'
                    ? Response::allow()
                    : Response::deny('Acesso não autorizado!');
         });
          
         Gate::define('srv', function($user) {
              return $user->perfil == 'srv'
                    ? Response::allow()
                    : Response::deny('Acesso não autorizado!');
          });

         Gate::define('ass', function($user) {
             return $user->perfil == 'ass';
         });

    }
}
