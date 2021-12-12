<?php

namespace P2pmessenger\P2pmessenger\core\config;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Config
 * @package P2pmessenger\P2pmessenger\core\config
 *
 * @method Core getCore()
 * @method Logger getLogger()
 * @method Router getRouter()
 * @method Core setCore()
 * @method Logger setLogger()
 * @method Router setRouter()
 */
class Config extends LazyJsonMapper implements ConfigInterface
{
    const JSON_PROPERTY_MAP = [
        'core' => 'Core',
        'logger' => 'Logger',
        'router' => 'Router',
    ];
}