<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         $this->registerPortalPolicies();
    }

    protected function registerPortalPolicies() {

      foreach($this->getPermissions() as $permission) {

          Gate::define($permission->name, function ($user) use ($permission) {

                  return $user->hasRole($permission->roles);
          });
      }

  }

  protected function getPermissions() {

      return Permission::with('roles')->get();

  }

}
