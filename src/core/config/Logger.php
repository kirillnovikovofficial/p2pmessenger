<?php

namespace P2pmessenger\P2pmessenger\core\config;

use LazyJsonMapper\LazyJsonMapper;

/**
 * Class Logger
 * @package P2pmessenger\P2pmessenger\core\config
 *
 * @method string getBasedir()
 * @method bool getActive()
 * @method string[] getCategories()
 * @method string[] getHandlers()
 * @method string setBasedir()
 * @method bool SetActive()
 * @method string[] setCategories()
 * @method string[] setHandlers()
 */
class Logger extends LazyJsonMapper implements ConfigInterface
{
    public const HANDLER_STDOUT = 'stdout';
    public const HANDLER_FILE = 'file';

    const JSON_PROPERTY_MAP = [
        'basedir' => 'string',
        'active' => 'bool',
        'categories' => 'string[]',
        'handlers' => 'string[]',
    ];
}