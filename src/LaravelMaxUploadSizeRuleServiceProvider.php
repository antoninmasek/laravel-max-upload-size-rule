<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMaxUploadSizeRuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-max-upload-size-rule');
    }

    public function packageRegistered(): void
    {
        File::macro('maxUploadSize', function (): Rule {
            $size = (new MaxUploadSizeRule())->getMaxUploadSize();

            return $size >= 0
                ? File::default()->max($size)
                : File::default();
        });
    }
}
