<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('Super Admin', function (User $user) {
            return $user->isSuperAdmin();
        });
        $permissions = Permission::all();
        foreach($permissions as $per){
            Gate::define($per->name, function (User $user) use ($per) {
                return $user->checkPermission($per->name);
            });
        }
    }
}
