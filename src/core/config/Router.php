<?php

namespace P2pmessenger\P2pmessenger\core\config;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Router
 * @package P2pmessenger\P2pmessenger\core\config
 *
 * @method string getBasedir()
 * @method string[] getFolders()
 * @method string setBasedir()
 * @method string[] setFolders()
 */
class Router extends LazyJsonMapper implements ConfigInterface
{
    const JSON_PROPERTY_MAP = [
        'basedir' => 'string',
        'folders' => 'string[]',
    ];
}