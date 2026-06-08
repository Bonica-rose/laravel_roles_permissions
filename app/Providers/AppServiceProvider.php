<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force Laravel to use clean Tailwind layout for links
        Paginator::useTailwind(); 

        Gate::before(function($user,$ability){
            return $user->hasRole('super admin')? true: null;
        });
    }
}
