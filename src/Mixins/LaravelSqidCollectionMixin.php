<?php

declare(strict_types=1);

namespace Lava83\LaravelSqid\Mixins;

use Closure;
use Illuminate\Support\Collection;

/** @mixin Collection */
class LaravelSqidCollectionMixin
{
    public function sqidsEncode(): Closure
    {
        return function () {
            return sqid_encode($this->all());
        };
    }
}
