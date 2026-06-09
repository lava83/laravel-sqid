<?php

namespace Lava83\LaravelSqid;

use Illuminate\Support\Collection;
use Lava83\LaravelSqid\Exceptions\OnlyIntegersCanBeSqidEncoded;
use Sqids\Sqids;

readonly class LaravelSqid
{
    public function __construct(
        private Sqids $sqids,
    ) {}

    /**
     * @param  array<int>|Collection<int>  $data
     */
    public function encode(array|Collection $data): string
    {
        $this->ensureOnlyIntegersToSqiding($data);

        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        return $this->sqids->encode($data);
    }

    /**
     * @return Collection<int>
     */
    public function decode(string $data): Collection
    {
        return collect($this->sqids->decode($data));
    }

    private function ensureOnlyIntegersToSqiding(array|Collection $data): void
    {
        if (! ($data instanceof Collection)) {
            $data = collect($data);
        }

        if ($data->filter(fn ($item) => ! is_int($item))->isNotEmpty()) {
            throw OnlyIntegersCanBeSqidEncoded::make();
        }
    }
}
