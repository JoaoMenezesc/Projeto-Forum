<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
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
        Post::class => PostPolicy::class,
        Comment::class => PostPolicy::class,
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
