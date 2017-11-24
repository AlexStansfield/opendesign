<?php

namespace App\Providers;

use App\Services\GitHubService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\GitHubService', function() {
            return new GitHubService(
                new Client(),
                ['clientId' => env('GITHUB_CLIENT_ID'), 'clientSecret' => env('GITHUB_CLIENT_SECRET')]
            );
        });
    }
}
