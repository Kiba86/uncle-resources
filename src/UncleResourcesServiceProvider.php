<?php
namespace UncleProject\UncleResources;

use Illuminate\Support\ServiceProvider;


class UncleResourcesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/resources.php', 'uncle'
        );

        $this->commands([
            \UncleProject\UncleResources\Command\InfoCommand::class,
            \UncleProject\UncleResources\Command\InstallerCommand::class,

        ]);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}