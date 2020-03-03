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
        $this->commands([
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
        $i = 1;
    }
}