<?php

namespace P2pmessenger\P2pmessenger\core\helpers\traits;

trait SetterTrait
{
    public function __set(string $name, mixed $value): void
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException('Property not set.');
        }

        $this->$name = $value;
    }
}