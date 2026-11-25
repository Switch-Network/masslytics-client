<?php

namespace SwitchNetwork\Masslytics;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MasslyticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('masslytics')
            ->hasConfigFile();
    }
}
