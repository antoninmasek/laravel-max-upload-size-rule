<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule\Tests;

use AntoninMasek\LaravelMaxUploadSizeRule\LaravelMaxUploadSizeRuleServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'AntoninMasek\\LaravelMaxUploadSizeRule\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMaxUploadSizeRuleServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-max-upload-size-rule_table.php.stub';
        $migration->up();
        */
    }
}
