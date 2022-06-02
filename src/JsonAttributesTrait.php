<?php

namespace Darkeum\JsonAttributes;

use Illuminate\Support\Collection;
use Darkeum\JsonAttributes\Casts\JsonAttributes as JsonAttributesCast;

/**
 * @property array $JsonAttributes
 *
 * @mixin Collection
 */
trait JsonAttributesTrait
{
    public function initializeJsonAttributesTrait(): void
    {
        foreach ($this->getJsonAttributes() as $attribute) {
            $this->casts[$attribute] = JsonAttributesCast::class;
        }
    }

    public function getJsonAttributes(): array
    {
        return $this->JsonAttributes ?? [];
    }

    /**
     * @param $key
     * @return mixed|JsonAttributes
     */
    public function __get($key)
    {
        if (in_array($key, $this->getJsonAttributes(), true)) {
            return JsonAttributes::createForModel($this, $key);
        }

        return parent::__get($key);
    }
}
