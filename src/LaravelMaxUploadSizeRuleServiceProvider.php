<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\App;
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
        /**
         * This method is here in order to mock calls to `ini_get` when testing.
         */
        App::macro('getPhpIniValue', function (string $key): false|string {
            return ini_get($key);
        });

        File::macro('maxUploadSize', function (): Rule {
            $uploadMaxSizeInBytes = ini_parse_quantity(App::getPhpIniValue('upload_max_filesize'));
            if ($uploadMaxSizeInBytes > 0) {
                return $this->max($uploadMaxSizeInBytes / 1024);
            }

            $postMaxSizeInBytes = ini_parse_quantity(App::getPhpIniValue('post_max_size'));
            if ($postMaxSizeInBytes > 0) {
                return $this->max($postMaxSizeInBytes / 1024);
            }

            return $this;
        });
    }
}
