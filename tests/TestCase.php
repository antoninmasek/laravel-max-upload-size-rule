<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule\Tests;

use AntoninMasek\LaravelMaxUploadSizeRule\LaravelMaxUploadSizeRuleServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelMaxUploadSizeRuleServiceProvider::class,
        ];
    }
}
