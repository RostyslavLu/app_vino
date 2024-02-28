<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        // C'est pour la base de données
        Schema::defaultStringLength(191);

        // Ceci permet de partager des données avec toutes les pages de l'app.
        Inertia::share([
            'cellar' => function () {
                return Auth::user() ? Auth::user()->cellars()->first() : null;
            },
        ]);
    }
}
