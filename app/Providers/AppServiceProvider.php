<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Mailgun -> https://github.com/Bogardo/Mailgun
        $this->app->bind('mailgun.client', function() {
        	return \Http\Adapter\Guzzle6\Client::createWithConfig([
        		// your Guzzle6 configuration
        	]);
        });
    }
}
