<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Materiel;
use App\Policies\MaterielPolicy;
use App\Models\Archive;
use App\Policies\ArchivePolicy;

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
        Gate::policy(Materiel::class, MaterielPolicy::class);
        Gate::policy(Archive::class, ArchivePolicy::class);

    }
}