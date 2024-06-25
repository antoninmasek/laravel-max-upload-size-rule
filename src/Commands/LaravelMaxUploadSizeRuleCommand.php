<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule\Commands;

use Illuminate\Console\Command;

class LaravelMaxUploadSizeRuleCommand extends Command
{
    public $signature = 'laravel-max-upload-size-rule';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
