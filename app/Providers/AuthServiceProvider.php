<?php

namespace App\Providers;

use App\Permission;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->defineGateUser();
        // Gate::define('is-admin', function($user){
        //     // dd($user);
        //     return $user->is_admin;
        // });
        
        // Gate::define('list_user', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.access.list_user'));
        // });
        // Gate::define('list_role', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.access.list_role'));
        // });
        // Gate::define('add_user', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.access.add_user'));
        // });
    }
    //cách 2 dúng policy
    public function defineGateUser(){
        Gate::define('list_user', 'App\Policies\UserPolicy@View');
        Gate::define('add_user', 'App\Policies\UserPolicy@create');
        Gate::define('edit_user', 'App\Policies\UserPolicy@update');
        Gate::define('delete_user', 'App\Policies\UserPolicy@delete');
    }
}
