<?php

namespace Eticsoft\Sanalpospro\Common\Models;

abstract class Entity
{
    /**
     * Convert the entity to an array
     */
    abstract public function toArray(): array;

    /**
     * Convert the entity to a JSON string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Convert the entity to a pretty printed JSON string
     */
    public function toPrettyJson(): string
    {
        return $this->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Convert the entity to a string (JSON representation)
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
