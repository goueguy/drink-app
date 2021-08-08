<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissions = [
            "manage-users"=>"Manage Users",
            "manage-roles"=>"Manage Rôles",
            "manage-commandes"=>"Manage Commandes",
            "manage-boissons"=>"Manage Boissons",
            "manage-fournisseurs"=>"Manage Fournisseurs",
            "manage-clients"=>"Manage Clients",
            "manage-categories"=>"Manage Catégories Boissons"
        ];

        foreach ($permissions as $key => $value) {
            Gate::define($key, function (User $user) use ($value){
                return $user->role->hasPermissions([$value]);
            });
        }

    }
}
