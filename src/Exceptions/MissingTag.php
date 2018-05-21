<?php

namespace Spatie\Html\Exceptions;

use Exception;

class MissingTag extends Exception
{
    /**
     * @return self
     */
    public static function onClass($className)
    {
        return new self("Class {$className} has nog `\$tag` property");
    }
}
