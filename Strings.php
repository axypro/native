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
     * Returns the length of the string
     *
     * @param string $string
     * @return int
     */
    public static function length($string)
    {
        return mb_strlen($string, self::$encoding);
    }

    /**
     * Returns the position of first occurrence of the needle in the haystack
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return int|bool
     *         the needle position or FALSE if it is not found
     */
    public static function pos($haystack, $needle, $offset = null)
    {
        return mb_strpos($haystack, $needle, $offset, self::$encoding);
    }

    /**
     * Returns the position of first occurrence of the needle in the haystack (case insensitive)
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return int|bool
     *         the needle position or FALSE if it is not found
     */
    public static function ipos($haystack, $needle, $offset = null)
    {
        return mb_stripos($haystack, $needle, $offset, self::$encoding);
    }

    /**
     * Checks if the haystack contains the needle
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return bool
     */
    public static function contains($haystack, $needle, $offset = null)
    {
        return (mb_strpos($haystack, $needle, $offset, self::$encoding) !== false);
    }

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
