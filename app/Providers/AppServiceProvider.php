<?php

namespace App\Providers;

use App\Repositories\InterfaceLogRepository;
use App\Repositories\LogRepository;
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
        // binding of repos
        app()->bind(InterfaceLogRepository::class, LogRepository::class);
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
