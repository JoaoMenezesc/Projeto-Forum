<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Os mapeamentos de política para o modelo da aplicação.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registre quaisquer serviços de autenticação/authorization.
     *
     * @return void
     */
    public function boot()
    {

        Gate::before(function (User $user, $ability) {
            if ($user->abilities()->contains($ability)) {
                return true;
            }

        
        });
    }
}
