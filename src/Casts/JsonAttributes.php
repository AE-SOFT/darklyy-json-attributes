<?php

namespace Darkeum\JsonAttributes\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Darkeum\JsonAttributes\JsonAttributes as BaseJsonAttributes;

class JsonAttributes implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return \Darkeum\JsonAttributes\JsonAttributes
     */
    public function get($model, $key, $value, $attributes)
    {
        return new BaseJsonAttributes($model, $key);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string $key
     * @param  \Darkeum\JsonAttributes\JsonAttributes $value
     * @param  array $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        if ($this->isJsonArray($value)) {
            return $value;
        }

        $json = json_encode($value);

        if (! is_array(json_decode($json, true))) {
            return null;
        }

        return $json;
    }

    protected function isJsonArray($value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        $array = json_decode($value, true);

        if (! is_array($array)) {
            return false;
        }

        return $value === json_encode($array);
    }
}
