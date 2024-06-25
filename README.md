# Easily validate uploaded file size against `upload_max_filesize` php.ini setting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/antoninmasek/laravel-max-upload-size-rule.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-max-upload-size-rule)
[![Total Downloads](https://img.shields.io/packagist/dt/antoninmasek/laravel-max-upload-size-rule.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-max-upload-size-rule)

On a few projects I've worked on, I noticed, that quite often we want to allow the max file size to be the same as our setting inside php.ini. Over time the value inside php.ini might change due to different requirements, but the validation rules usually stay the same until some user hits the rule and it prevents them from proceeding.

Thanks to this rule the max file size is automatically loaded based on the current php.ini setting hence it stays in sync.

## Installation

You can install the package via composer:

```bash
composer require antoninmasek/laravel-max-upload-size-rule
```

## Basic usage

```php
Validator::make(['file', $file], [Rule::file()->maxUploadSize()]);
```

## Testing

```bash
composer test
```

## Credits

- [Antonin Masek](https://github.com/antoninmasek)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
