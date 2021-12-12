<?php

namespace P2pmessenger\P2pmessenger\components\ssl\exceptions;

use Throwable;

class InvalidSSLDataException extends \InvalidArgumentException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = 'The data does not match.';
        }
        parent::__construct($message, $code, $previous);
    }
}