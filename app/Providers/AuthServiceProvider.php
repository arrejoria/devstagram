<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Comentario;
use App\Policies\ComentarioPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comentario::class => ComentarioPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('delete-comment', [ComentarioPolicy::class, 'delete']);
        //
    }
}
