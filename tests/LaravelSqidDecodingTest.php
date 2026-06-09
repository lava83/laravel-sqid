<?php

declare(strict_types=1);

use Lava83\LaravelSqid\Facades\LaravelSqid;

it('can decode a sqid string', function () {
    $data = '86Rf07';
    $decoded = LaravelSqid::decode($data);

    expect($decoded)->toEqual(collect([1, 2, 3]));
});
