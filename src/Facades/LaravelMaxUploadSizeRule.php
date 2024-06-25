<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AntoninMasek\LaravelMaxUploadSizeRule\LaravelMaxUploadSizeRule
 */
class LaravelMaxUploadSizeRule extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AntoninMasek\LaravelMaxUploadSizeRule\LaravelMaxUploadSizeRule::class;
    }
}
