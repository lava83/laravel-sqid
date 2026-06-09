<?php

declare(strict_types=1);

namespace Lava83\LaravelSqid\Exceptions;

use InvalidArgumentException;

class OnlyIntegersCanBeSqidEncoded extends InvalidArgumentException
{
    public static function make(): self
    {
        return new self('Only integers can be Sqid encoded');
    }
}
