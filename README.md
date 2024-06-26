# Easily validate uploaded file size against `upload_max_filesize` php.ini setting

[![Latest Version on Packagist](https://img.shields.io/packagist/v/antoninmasek/laravel-max-upload-size-rule.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-max-upload-size-rule)
[![Total Downloads](https://img.shields.io/packagist/dt/antoninmasek/laravel-max-upload-size-rule.svg?style=flat-square)](https://packagist.org/packages/antoninmasek/laravel-max-upload-size-rule)

On a few projects I've worked on, I noticed, that quite often we want to allow the max file size to be the same as our
setting inside php.ini. Over time the value inside php.ini might change due to different requirements, but the
validation rules usually stay the same until some user hits the rule and it prevents them from proceeding.

Thanks to this rule the max file size is automatically loaded based on the current php.ini setting hence it stays in
sync.

## Installation

You can install the package via composer:

```bash
composer require antoninmasek/laravel-max-upload-size-rule
```

## Basic usage

```php
Validator::make(['file', $file], [Rule::file()->maxUploadSize()]);
Validator::make(['file', $file], [new MaxUploadSizeRule()]);
```

### Files larger than `max_upload_size`

Please note, that if the file is larger than `max_upload_size`, then you will receive the following error message: "The
file failed to upload.". The reason is, that even if you try to inspect the uploaded file you will find out, that it has
an error and is not uploaded, because it exceeds the limit.

### Files larger than `post_max_size`

In this case, Laravel will throw an exception. In production, you might see "413 Content Too Large" and in debug mode,
you would see "PostTooLargeException".

### Why use the rule then

As mentioned above - thanks to this you will have the max allowed filesize in sync with the
`php.ini`, so it basically means you are using the existing max rule, but it always uses the current setting based on
`php.ini`. In all other ways, it behaves exactly like the max rule.

## Testing

```bash
composer test
```

## Credits

- [Antonin Masek](https://github.com/antoninmasek)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
