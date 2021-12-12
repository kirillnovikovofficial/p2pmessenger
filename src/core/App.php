<?php

namespace P2pmessenger\P2pmessenger\core;

use P2pmessenger\P2pmessenger\components\ssl\GenerateSSL;
use P2pmessenger\P2pmessenger\core\config\Config;
use P2pmessenger\P2pmessenger\core\helpers\Router;
use P2pmessenger\P2pmessenger\core\config\Router as RouterConfig;
use P2pmessenger\P2pmessenger\core\helpers\Singleton;
use P2pmessenger\P2pmessenger\core\helpers\traits\GetterTrait;

/**
 * Class App
 * @package P2pmessenger\P2pmessenger
 *
 * @property Router $router
 */
final class App extends Singleton
{
    private static ?self $instance = null;

    private ?Router $router = null;

    use GetterTrait;

    public static function getInstance(?Config $config = null): self
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    protected function __construct(Config $config)
    {
        parent::__construct($config);

        $this->router = Router::getInstance($config->getRouter() ?? new RouterConfig());
    }

    public function init()
    {
        new GenerateSSL();
    }

}