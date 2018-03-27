<?php

namespace Block8\ExternalAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Graph\GraphExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;

class ExternalAuthServiceProvider extends ServiceProvider
{
    protected $assets = ['js' => [], 'css' => []];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->app['events']->listen(SocialiteWasCalled::class, GraphExtendSocialite::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/services.php', 'services');
    }
}
