<?php

namespace P2pmessenger\P2pmessenger\core\config;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Config
 * @package P2pmessenger\P2pmessenger\core\config
 *
 * @method Core getCore()
 * @method Router getRouter()
 * @method Core setCore()
 * @method Router setRouter()
 */
class Config extends LazyJsonMapper implements ConfigInterface
{
    const JSON_PROPERTY_MAP = [
        'core' => 'Core',
        'router' => 'Router',
    ];
}