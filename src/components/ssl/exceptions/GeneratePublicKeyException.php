<?php

namespace P2pmessenger\P2pmessenger\components\ssl\exceptions;

use Throwable;

class GeneratePublicKeyException extends \RuntimeException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = 'Failed to write data to file.';
        }
        parent::__construct($message, $code, $previous);
    }
}