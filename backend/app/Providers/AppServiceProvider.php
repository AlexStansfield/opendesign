<?php

namespace App\Providers;

use App\Services\GitHubService;
use App\Services\ImageUploaderService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

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

        $this->app->bind('App\Services\ImageUploaderService', function() {
            return new ImageUploaderService(
                new ImageManager()
            );
        });
    }
}
