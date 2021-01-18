<?php

namespace Akkurate\LaravelAccountSubmodule\Providers;

use Akkurate\LaravelAccountSubmodule\Policies\PermissionPolicy;
use Akkurate\LaravelAccountSubmodule\Policies\RolePolicy;
use Akkurate\LaravelAccountSubmodule\Models\Account;
use Akkurate\LaravelAccountSubmodule\Models\User;
use Akkurate\LaravelAccountSubmodule\Policies\AccountPolicy;
use Akkurate\LaravelAccountSubmodule\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Account::class => AccountPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
