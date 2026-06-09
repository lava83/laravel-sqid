<?php

declare(strict_types=1);

use Lava83\LaravelSqid\Exceptions\OnlyIntegersCanBeSqidEncoded;

it('can encode a collection', function () {
    $collection = collect([1, 2, 3]);
    $encoded = $collection->sqidsEncode();

    expect($encoded)
        ->toBeString()
        ->and($encoded)
        ->toEqual('86Rf07');
});

it('throws an exception when trying to encode a collection with non-integer values', function () {
    $collection = collect(['a', 'b', 'c']);
    $collection->sqidsEncode();
})->throws(OnlyIntegersCanBeSqidEncoded::class, 'Only integers can be Sqid encoded');
