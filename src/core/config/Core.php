<?php

namespace P2pmessenger\P2pmessenger\core\config;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Core
 * @package P2pmessenger\P2pmessenger\core\config
 *
 * @method string getTimezone()
 * @method string getMemoryLimit()
 * @method string setTimezone()
 * @method string setMemoryLimit()
 */
class Core extends LazyJsonMapper implements ConfigInterface
{
    const JSON_PROPERTY_MAP = [
        'timezone' => 'string',
        'memoryLimit' => 'string',
    ];
}