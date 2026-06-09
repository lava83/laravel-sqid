<?php

namespace Lava83\LaravelSqid;

use Illuminate\Support\Collection;
use Lava83\LaravelSqid\Mixins\LaravelSqidCollectionMixin;
use ReflectionException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Sqids\Sqids;

class LaravelSqidServiceProvider extends PackageServiceProvider
{
    public function registeringPackage(): void
    {
        parent::registeringPackage();

        $this->registerBindings();
    }

    /**
     * @throws ReflectionException
     */
    public function packageBooted(): void
    {
        parent::packageBooted();

        $this->bootMixins();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-sqid')
            ->hasConfigFile()
            ->hasViews();
    }

    /**
     * @throws ReflectionException
     */
    private function bootMixins(): void
    {
        Collection::mixin(new LaravelSqidCollectionMixin);
    }

    private function registerBindings(): void
    {
        $this->app->bind(Sqids::class, function () {
            return new Sqids(
                alphabet: config('sqid.alphabet'),
                minLength: config('sqid.min_length'),
                blocklist: config('sqid.blocklist'),
            );
        });
    }
}
