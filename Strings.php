<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native;

/**
 * String functions
 */
class Strings
{
    /**
     * Sets the internal encoding of the class
     *
     * @param string $encoding
     */
    public static function setInternalEncoding($encoding)
    {
        self::$encoding = $encoding;
    }

    /**
     * Returns the internal encoding of the class
     *
     * @return string
     */
    public static function getInternalEncoding()
    {
        return self::$encoding;
    }

    /**
     * The internal encoding of the class
     *
     * @var string
     */
    private static $encoding = 'UTF-8';
}
