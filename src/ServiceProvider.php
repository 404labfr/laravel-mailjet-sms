<?php

namespace Lab404\LaravelMailjetSms;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /** @var bool $defer */
    protected $defer = false;
    /** @var string $configName */
    protected $configName = 'mailjetsms';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/' . $this->configName . '.php';

        $this->mergeConfigFrom($configPath, $this->configName);

        $this->app->bind(MailjetSms::class, MailjetSms::class);

        $this->app->singleton('mailjetsms', function($app) {
            return new MailjetSms($app);
        });

        $this->app->alias('mailjetsms', MailjetSms::class);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/' . $this->configName . '.php';

        $this->publishes([$configPath => config_path($this->configName . '.php')], 'config');
    }
}
