<?php

namespace KyleWLawrence\BetterStack\Providers;

use Illuminate\Support\ServiceProvider;
use KyleWLawrence\BetterStack\Services\BetterStackService;
use KyleWLawrence\BetterStack\Services\NullService;

class BetterStackServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider and merge config.
     *
     * @return void
     */
    public function register()
    {
        $packageName = 'betterstack-laravel';
        $configPath = __DIR__.'/../../config/betterstack-laravel.php';

        $this->mergeConfigFrom(
            $configPath, $packageName
        );

        $this->publishes([
            $configPath => config_path(sprintf('%s.php', $packageName)),
        ]);
    }

    /**
     * Bind service to 'BetterStack' for use with Facade.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('BetterStack', function () {
            $driver = config('betterstack-laravel.driver', 'api');
            if (is_null($driver) || $driver === 'log') {
                return new NullService($driver === 'log');
            }

            return new BetterStackService;
        });
    }
}
