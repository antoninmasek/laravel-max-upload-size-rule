<?php

use AntoninMasek\LaravelMaxUploadSizeRule\MaxUploadSizeRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

function passes(int $fileSize, ValidationRule|Rule $rule): bool
{
    return Validator::make(
        ['file' => UploadedFile::fake()->create('foo.txt', $fileSize)],
        ['file' => $rule],
    )->passes();
}

it('can validate based on upload max file size limit', function () {
    $rule = Mockery::mock(MaxUploadSizeRule::class)->makePartial();
    $rule
        ->shouldAllowMockingProtectedMethods()
        ->shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(1024);

    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate based on post max size limit', function () {
    $rule = Mockery::mock(MaxUploadSizeRule::class)
        ->makePartial();

    $rule->shouldAllowMockingProtectedMethods();

    $rule
        ->shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(-1);

    $rule
        ->shouldReceive('getPhpIniValue')
        ->with('post_max_size')
        ->andReturn(1024);

    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate without size limit', function () {
    $rule = Mockery::mock(MaxUploadSizeRule::class)
        ->makePartial();

    $rule->shouldAllowMockingProtectedMethods();

    $rule
        ->shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(-1);

    $rule
        ->shouldReceive('getPhpIniValue')
        ->with('post_max_size')
        ->andReturn(-1);

    expect(passes(1025, $rule))->toBeTrue()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

afterEach(function () {
    Mockery::close();
});
