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
}
