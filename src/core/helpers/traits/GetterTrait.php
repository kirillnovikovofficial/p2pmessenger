<?php

namespace P2pmessenger\P2pmessenger\core\helpers\traits;

trait GetterTrait
{
    public function __get(string $name): mixed
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException('Property not set.');
        }

        return $this->$name;
    }
}