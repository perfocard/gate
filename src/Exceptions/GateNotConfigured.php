<?php

namespace Perfocard\Gate\Exceptions;

use Exception;

class GateNotConfigured extends Exception
{
    public function __construct($message = null, $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message ?: static::message(), $code, $previous);
    }

    public static function message(): string
    {
        return 'Gate enabled but URL is not configured.';
    }
}
