<?php

namespace P2pmessenger\P2pmessenger\core\helpers;

use P2pmessenger\P2pmessenger\core\config\ConfigInterface;

abstract class Singleton
{
    protected ?ConfigInterface $config = null;

    protected function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton.");
    }
}