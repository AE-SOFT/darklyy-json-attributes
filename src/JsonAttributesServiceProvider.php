<?php

namespace Darkeum\JsonAttributes;

use Illuminate\Database\Schema\Blueprint;
use Darkeum\DarklyyPackageTools\Package;
use Darkeum\DarklyyPackageTools\PackageServiceProvider;

class JsonAttributesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('darklyy-json-attributes');
    }

    public function registeringPackage(): void
    {
        Blueprint::macro('JsonAttributes', function (string $columnName = 'json_attributes') {
            return $this->json($columnName)->nullable();
        });
    }
}
