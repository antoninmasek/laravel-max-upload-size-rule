<?php

use AntoninMasek\LaravelMaxUploadSizeRule\MaxUploadSizeRule;
use Illuminate\Contracts\Validation\Rule as RuleContract;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

function toBytes(int $kiloBytes): int
{
    return $kiloBytes * 1024;
}

function passes(int $kiloBytes, ValidationRule|RuleContract $rule): bool
{
    return Validator::make(
        ['file' => UploadedFile::fake()->create('foo.txt', $kiloBytes)],
        ['file' => $rule],
    )->passes();
}

it('can validate based on upload max file size limit', function () {
    App::shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(toBytes(1024));

    $rule = new MaxUploadSizeRule();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();

    $rule = Rule::file()->maxUploadSize();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate based on upload max file size limit using shorthand notation', function () {
    App::shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn('1024k');

    $rule = new MaxUploadSizeRule();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();

    $rule = Rule::file()->maxUploadSize();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate based on post max size limit', function () {
    App::shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(-1);

    App::shouldReceive('getPhpIniValue')
        ->with('post_max_size')
        ->andReturn(toBytes(1024));

    $rule = new MaxUploadSizeRule();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();

    $rule = Rule::file()->maxUploadSize();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate based on post max size limit using shorthand notation', function () {
    App::shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(-1);

    App::shouldReceive('getPhpIniValue')
        ->with('post_max_size')
        ->andReturn('1024k');

    $rule = new MaxUploadSizeRule();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();

    $rule = Rule::file()->maxUploadSize();
    expect(passes(1025, $rule))->toBeFalse()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

it('can validate without size limit', function () {
    App::shouldReceive('getPhpIniValue')
        ->with('upload_max_filesize')
        ->andReturn(-1);

    App::shouldReceive('getPhpIniValue')
        ->with('post_max_size')
        ->andReturn(-1);

    $rule = new MaxUploadSizeRule();
    expect(passes(1025, $rule))->toBeTrue()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();

    $rule = Rule::file()->maxUploadSize();
    expect(passes(1025, $rule))->toBeTrue()
        ->and(passes(1024, $rule))->toBeTrue()
        ->and(passes(1023, $rule))->toBeTrue()
        ->and(passes(512, $rule))->toBeTrue();
});

afterEach(function () {
    Mockery::close();
});
