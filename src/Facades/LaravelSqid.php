<?php

namespace Lava83\LaravelSqid\Facades;

use Illuminate\Support\Facades\Facade;
use Lava83\LaravelSqid\LaravelSqid as LaravelSqidAccessor;

/**
 * @see LaravelSqidAccessor
 */
class LaravelSqid extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaravelSqidAccessor::class;
    }
}
