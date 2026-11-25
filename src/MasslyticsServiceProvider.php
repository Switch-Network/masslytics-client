<?php

namespace SwitchNetwork\Masslytics;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SwitchNetwork\Masslytics\Commands\MasslyticsCommand;

class MasslyticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('masslytics-client')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_masslytics_client_table')
            ->hasCommand(MasslyticsCommand::class);
    }
}
