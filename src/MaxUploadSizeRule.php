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
        $rule = Rule::file()->maxUploadSize();

        $validator = Validator::make(
            [$attribute => $value],
            [$attribute => $rule]
        );

        if ($validator->fails()) {
            $fail(Arr::first($rule->message()));
        }
    }
}
