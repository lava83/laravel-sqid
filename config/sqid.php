<?php

declare(strict_types=1);

namespace Lava83\LaravelSqid;

use Sqids\Sqids;

return [
    'min_length' => env('LARAVEL_SQID_MIN_LENGTH', Sqids::DEFAULT_MIN_LENGTH),
    'alphabet' => env('LARAVEL_SQID_ALPHABET', Sqids::DEFAULT_ALPHABET),
    'blocklist' => env('LARAVEL_SQID_BLOCKLIST', Sqids::DEFAULT_BLOCKLIST),
];
