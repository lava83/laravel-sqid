<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Lava83\LaravelSqid\Facades\LaravelSqid;

if (! function_exists('sqid_encode')) {
    /**
     * @param  array<int>|Collection<int>  $data
     */
    function sqid_encode(array|Collection $data): string
    {
        return LaravelSqid::encode($data);
    }
}

if (! function_exists('sqid_decode')) {
    /**
     * @return Collection<int>
     */
    function sqid_decode(string $data): Collection
    {
        return LaravelSqid::decode($data);
    }
}
