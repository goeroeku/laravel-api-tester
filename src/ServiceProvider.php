<?php

namespace Asvae\ApiTester;

use Asvae\ApiTester\Contracts\RouteRepositoryInterface;
use Asvae\ApiTester\Providers\RouteServiceProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        if (!defined('API_TESTER_PATH')) {
            define('API_TESTER_PATH', realpath(__DIR__.'/../'));
        }
        
        $this->app->register(RouteServiceProvider::class);
        $this->mergeConfigFrom(API_TESTER_PATH.'/config/api-tester.php',
            'api-tester');

        $this->app->bind(RouteRepositoryInterface::class,
            config('api-tester.repository'));
    }

    public function boot()
    {
        $this->publishes([
            API_TESTER_PATH.'/config/api-tester.php' => config_path('api-tester.php'),
        ], 'config');
    }
}
