<?php

declare(strict_types=1);

use Lava83\LaravelSqid\Exceptions\OnlyIntegersCanBeSqidEncoded;
use Lava83\LaravelSqid\Facades\LaravelSqid;

it('encodes integer array', function () {
    $data = [1, 2, 3];
    $encoded = LaravelSqid::encode($data);

    expect($encoded)->toEqual('86Rf07');
});

it('encodes integer collection', function () {
    $data = collect([1, 2, 3]);
    $encoded = LaravelSqid::encode($data);

    expect($encoded)->toEqual('86Rf07');
});

it('can only encode integers', function () {
    $data = collect([1, 2, 'foo']);
    LaravelSqid::encode($data);
})->throws(OnlyIntegersCanBeSqidEncoded::class, 'Only integers can be Sqid encoded');
