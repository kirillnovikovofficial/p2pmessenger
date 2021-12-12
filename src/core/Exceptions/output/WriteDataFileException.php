<?php

namespace P2pmessenger\P2pmessenger\core\Exceptions\output;

use Throwable;

class WriteDataFileException extends \RuntimeException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = 'The data does not match.';
        }
        parent::__construct($message, $code, $previous);
    }
}