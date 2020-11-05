# Laravel Sovren

![Latest Version on Packagist](https://img.shields.io/packagist/v/via-work/laravel-sovren.svg?style=popout)
[![Build Status](https://travis-ci.com/via-work/laravel-sovren.svg?token=QwJXKd8HHGkzaHzVxmjG&branch=master)](https://travis-ci.com/via-work/laravel-sovren)
[![Quality Score](https://img.shields.io/scrutinizer/g/via-work/laravel-sovren.svg?style=popout)](https://scrutinizer-ci.com/g/via-work/laravel-sovren)
[![Total Downloads](https://img.shields.io/packagist/dm/via-work/laravel-sovren.svg?style=popout)](https://packagist.org/packages/via-work/laravel-sovren)

Very simple package to use the Sovren API inside Laravel.

## Archived

We are no longer using Sovren in our projects so we can not longer mantain this repo. 


## Installation

You can install the package via composer:


```bash
composer require via-work/laravel-sovren
```

## Usage

After installing, the package will automatically register its service provider.

To publish the config file to config/sovren.php run:

```bash
php artisan vendor:publish --provider="Via\LaravelSovren\SovrenFacade"
```

And change your API keys accordingly.

### Testing

``` bash
composer test
```

### Security

If you discover any security related issues, please email alfonso@via.work instead of using the issue tracker.

## Credits

- [Alfonso Strotgen](https://github.com/strotgen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
