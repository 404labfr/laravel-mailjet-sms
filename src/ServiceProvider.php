<?php

namespace Lab404\LaravelMailjetSms;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /** @var string $configName */
    protected $configName = 'mailjetsms';

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

    public function boot()
    {
        $configPath = __DIR__ . '/../config/' . $this->configName . '.php';

        $this->publishes([$configPath => config_path($this->configName . '.php')], 'config');
    }
}
