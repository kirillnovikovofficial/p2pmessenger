<?php

namespace P2pmessenger\P2pmessenger\core\helpers;

use Monolog\Handler\StreamHandler;
use P2pmessenger\P2pmessenger\core\config\ConfigInterface;
use P2pmessenger\P2pmessenger\core\config\Logger as LoggerConfig;
use Psr\Log\LoggerInterface;

class Logger extends Singleton
{
    /** @var LoggerInterface[] */
    private static array $loggers = [];

    public static function getLoggers(LoggerConfig $config): array
    {
        foreach($config->getCategories() as $category) {
            $logger = new \Monolog\Logger($category);
            foreach ($config->getHandlers() as $handler) {
                switch ($handler) {
                    case LoggerConfig::HANDLER_FILE:
                        $logger->pushHandler(new StreamHandler($config->getBasedir() . $category, \Monolog\Logger::DEBUG));
                        break;
                    case LoggerConfig::HANDLER_STDOUT:
                        $logger->pushHandler(new StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
                        break;
                }
            }
            if (!isset(self::$loggers[$category])) {
                self::$loggers[$category] = $logger;
            }
            $logger->debug('Logger was added', ['time' => microtime(true)]);
        }

        return self::$loggers;
    }

    protected function __construct(ConfigInterface $config)
    {
        parent::__construct($config);
    }

}