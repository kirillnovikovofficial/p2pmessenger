<?php

namespace P2pmessenger\P2pmessenger\core\helpers;

use P2pmessenger\P2pmessenger\core\config\Core as CoreConfig;

class Core extends Singleton
{
    private static ?self $instance = null;

    public static function getInstance(CoreConfig $config): self
    {
        if (self::$instance === null) {
            self::$instance = new static($config);
        }

        return self::$instance;
    }

    protected function __construct(CoreConfig $config)
    {
        parent::__construct($config);
        $this->run();
    }

    private function run()
    {
        /** @var CoreConfig $config */
        $config = $this->config;

        @set_time_limit(0);
        @date_default_timezone_set($config->getTimezone() ?? 'UTC');
        @ini_set('memory_limit', $config->getMemoryLimit() ?? '128M');
    }

}