<?php

namespace AntoninMasek\LaravelMaxUploadSizeRule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MaxUploadSizeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (($maxUploadSize = $this->getMaxUploadSize()) < 0) {
            return;
        }

        $rule = Rule::file()->max($maxUploadSize);

        $validator = Validator::make(
            [$attribute => $value],
            [$attribute => $rule]
        );

        if ($validator->fails()) {
            $fail(Arr::first($rule->message()));
        }
    }

    /**
     * Parse max upload filesize from php.ini
     */
    public function getMaxUploadSize(): int
    {
        $uploadMaxSize = ini_parse_quantity($this->getPhpIniValue('upload_max_filesize'));
        if ($uploadMaxSize > 0) {
            return $uploadMaxSize;
        }

        $postMaxSize = ini_parse_quantity($this->getPhpIniValue('post_max_size'));
        if ($postMaxSize > 0) {
            return $postMaxSize;
        }

        return -1;
    }

    /**
     * This method is here in order to mock calls to `ini_get` when testing.
     */
    protected function getPhpIniValue(string $key): false|string
    {
        return ini_get($key);
    }
}
