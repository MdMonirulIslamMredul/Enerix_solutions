<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        // Share site settings globally across all views with request-level static caching and graceful DB failure handling
        View::composer('*', function ($view) {
            static $settings = null;
            if ($settings === null) {
                try {
                    $settings = Setting::first();
                } catch (\Throwable $e) {
                    $settings = null;
                }
            }
            $view->with('settings', $settings);
        });

        View::composer('frontend.partials.footer', function ($view) {
            $view->with('footerSolutions', Service::where('status', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get());
        });
    }
}
