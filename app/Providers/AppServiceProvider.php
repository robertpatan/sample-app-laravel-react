<?php

namespace App\Providers;

use App\Http\Entity\MovieEntity;
use App\Http\Repository\MovieRepository;
use App\Http\Services\MovieService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    
        $this->app->bind(MovieRepository::class, fn($app) => new MovieRepository(new MovieEntity()));
        
        $this->app->bind(MovieService::class, fn($app) => new MovieService(new MovieRepository( new MovieEntity())));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
