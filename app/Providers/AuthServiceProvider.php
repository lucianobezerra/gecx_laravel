<?php

namespace Gecx\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Gecx\Role;

class AuthServiceProvider extends ServiceProvider{

  protected $policies = ['Gecx\Model' => 'Gecx\Policies\ModelPolicy'];

  public function boot(GateContract $gate){
    $this->registerPolicies($gate);

    $gate->define('auth', function($user, $role=NULL){
      if($role === NULL){
        $actions = Route::current()->getAction();

        if(!isset($actions['role']))
          return false;
        $role = $actions['role'];
      }

      $objRole = new Role();
      $roles = $objRole->roles($user->id);

      if(in_array($role, $roles))
        return true;

      return false;  
    });
  }
}
