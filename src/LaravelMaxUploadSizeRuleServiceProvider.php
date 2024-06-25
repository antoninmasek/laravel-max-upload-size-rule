<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AntoninMasek\LaravelMaxUploadSizeRule\Commands\LaravelMaxUploadSizeRuleCommand;

class LaravelMaxUploadSizeRuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('laravel-max-upload-size-rule');
    }
}
