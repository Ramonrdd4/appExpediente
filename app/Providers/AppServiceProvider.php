<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('solo_adm', function ($user) {
            return $user->rol_id == 1? true:false;
          });
          Gate::define('solo_pacientedueno', function ($user) {
            return $user->rol_id == 3? true:false;
          });
          Gate::define('solo_medico', function ($user) {
            return $user->rol_id == 2? true:false;
          });
     

        Schema::defaultStringLength(191);
    }
}
