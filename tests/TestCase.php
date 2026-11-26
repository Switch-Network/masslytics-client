<?php

namespace SwitchNetwork\Masslytics\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SwitchNetwork\Masslytics\MasslyticsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MasslyticsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('masslytics.token', 'test-token');
        $app['config']->set('masslytics.url', 'https://masslytics.test/');
    }
}
