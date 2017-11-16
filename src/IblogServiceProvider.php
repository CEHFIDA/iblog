<?php
namespace Selfreliance\Iblog;
use Illuminate\Support\ServiceProvider;

class IblogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('Selfreliance\Iblog\BlogController');
        $this->loadViewsFrom(__DIR__ . '/views', 'iblog');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'translate-blog');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}