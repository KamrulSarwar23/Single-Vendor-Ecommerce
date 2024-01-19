<?php

namespace App\Providers;

// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set Time Zone

        $generalSetting = GeneralSetting::first();
        $logosetting = LogoSetting::first();

        Config::set('app.timezone', $generalSetting->time_zone);

        View::composer('*', function ($view) use ($generalSetting, $logosetting) {
            $view->with(['setting'=> $generalSetting, 'logosetting' => $logosetting]);
            });
        }
}
