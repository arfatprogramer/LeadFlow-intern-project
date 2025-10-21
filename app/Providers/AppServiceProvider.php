<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

     protected $policies = [
                // Model::class => ModelPolicy::class,
            ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      

       // Gate for Super_Admin or Admin
        Gate::define('is-admin-or-super-admin', function ($user) {
            return $user->roles->pluck('role_name')->intersect(['Super_Admin', 'Admin'])->count() > 0;
        });
        
        // Manager
        Gate::define('is-manager', function ($user) {
            return $user->roles->pluck('role_name')->intersect(['Super_Admin', 'Admin','Manager'])->count() > 0;
        });
    
        // Sales
        Gate::define('is-sales', function ($user) {
            return $user->roles->pluck('role_name')->intersect(['Super_Admin', 'Admin','Sales'])->count() > 0;
        });
        
        // Support
        Gate::define('is-support', function ($user) {
            return $user->roles->pluck('role_name')->intersect(['Super_Admin', 'Admin','Support'])->count() > 0;
        });
        
        // Test
        Gate::define('is-test', function ($user) {
            return $user->roles->pluck('role_name')->intersect(['Super_Admin', 'Admin','Test'])->count() > 0;
        });

        
    }
}
