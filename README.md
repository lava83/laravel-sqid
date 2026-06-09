# Laravel Sqid

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lava83/laravel-sqid.svg?style=flat-square)](https://packagist.org/packages/lava83/laravel-sqid)
[![GitHub Tests Action Status](https://github.com/lava83/laravel-sqid/actions/workflows/run-tests.yml/badge.svg)](https://github.com/lava83/laravel-sqid/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/lava83/laravel-sqid/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/lava83/laravel-sqid/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lava83/laravel-sqid.svg?style=flat-square)](https://packagist.org/packages/lava83/laravel-sqid)

A thin, idiomatic Laravel integration for [Sqids](https://sqids.org/). It encodes lists of integers into short, URL-friendly strings and decodes them back, configurable via `alphabet`, `min_length` and `blocklist`.

> **Note:** Sqids are **not** sequential, sortable or cryptographically secure, and they are **not** meant to replace database primary keys. They obfuscate integers into compact, unguessable-looking strings — for example to expose internal IDs in URLs without leaking the raw values.

```php
use Lava83\LaravelSqid\Facades\LaravelSqid;

LaravelSqid::encode([1, 2, 3]);   // "86Rf07"
LaravelSqid::decode('86Rf07');    // Collection: [1, 2, 3]
```

## Requirements

- PHP `^8.3`
- Laravel 12 or 13 (`illuminate/contracts` `^12.0||^13.0`)

## Installation

Install the package via Composer:

```bash
composer require lava83/laravel-sqid
```

The service provider and the `LaravelSqid` facade are registered automatically via package discovery.

Optionally publish the config file:

```bash
php artisan vendor:publish --tag="laravel-sqid-config"
```

## Configuration

The published `config/sqid.php` looks like this:

```php
use Sqids\Sqids;

return [
    'min_length' => env('LARAVEL_SQID_MIN_LENGTH', Sqids::DEFAULT_MIN_LENGTH),
    'alphabet' => env('LARAVEL_SQID_ALPHABET', Sqids::DEFAULT_ALPHABET),
    'blocklist' => env('LARAVEL_SQID_BLOCKLIST', Sqids::DEFAULT_BLOCKLIST),
];
```

All three options can be driven by environment variables:

| ENV variable               | Config key   | Description                                              |
|----------------------------|--------------|----------------------------------------------------------|
| `LARAVEL_SQID_MIN_LENGTH`  | `min_length` | Minimum length of the generated Sqid string.             |
| `LARAVEL_SQID_ALPHABET`    | `alphabet`   | Custom alphabet used for encoding.                       |
| `LARAVEL_SQID_BLOCKLIST`   | `blocklist`  | Words that must not appear in any generated Sqid string. |

The underlying `Sqids\Sqids` instance is bound in the container from this config, so customizing the config is all you need.

## Usage

### Facade

```php
use Lava83\LaravelSqid\Facades\LaravelSqid;

// Encode an array or a Collection of integers
LaravelSqid::encode([1, 2, 3]);          // "86Rf07"
LaravelSqid::encode(collect([1, 2, 3])); // "86Rf07"

// Decode back into a Collection<int>
LaravelSqid::decode('86Rf07');           // collect([1, 2, 3])
```

### Helpers

Global helper functions are available everywhere:

```php
sqid_encode([1, 2, 3]);   // "86Rf07"
sqid_decode('86Rf07');    // collect([1, 2, 3])
```

### Collection macro

A `sqidsEncode()` macro is mixed into `Illuminate\Support\Collection`:

```php
collect([1, 2, 3])->sqidsEncode(); // "86Rf07"
```

### Encoding only accepts integers

`encode()` (and therefore the helper and the collection macro) only accepts integers. Anything else throws an `OnlyIntegersCanBeSqidEncoded` exception:

```php
use Lava83\LaravelSqid\Exceptions\OnlyIntegersCanBeSqidEncoded;

LaravelSqid::encode([1, 2, 'foo']); // throws OnlyIntegersCanBeSqidEncoded
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Stefan Riedel](https://github.com/lava83)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
