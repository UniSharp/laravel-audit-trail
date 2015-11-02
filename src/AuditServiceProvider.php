<?php

namespace Unisharp\AuditTrail;

use Illuminate\Support\ServiceProvider;

/**
 * This is the auditing service provider class.
 *
 */
class AuditServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfigs();
        $this->setupFacades();
        $this->setupMigrations();     
    }

    /**
     * Setup the migrations.
     *
     * @return void
     */
    protected function setupMigrations()
    {
        $this->publishes([
            realpath(__DIR__ . '/migrations') => $this->app->databasePath().'/migrations',
            ]);
    }

    /**
     * Setup the configs.
     *
     * @return void
     */
    protected function setupConfigs()
    {
        $this->publishes([__DIR__ . '/config/audit.php' => config_path('audit.php', 'config'),], 'audit_config');
    }

    /**
     * Setup the facades.
     *
     * @return void
     */
    protected function setupFacades()
    {
        \App::bind('audit', function()
        {
            return new \Unisharp\AuditTrail\Audit;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}