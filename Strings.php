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
     * Checks if the haystack contains the needle (case insensitive)
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return bool
     */
    public static function icontains($haystack, $needle, $offset = null)
    {
        return (mb_stripos($haystack, $needle, $offset, self::$encoding) !== false);
    }

    /**
     * Checks if the haystack begins with the needle
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return bool
     */
    public static function begins($haystack, $needle, $offset = null)
    {
        // This is more efficient than strpos() for the short needle and the long haystack (tokenizer for example)
        $target = mb_substr($haystack, $offset ?: 0, mb_strlen($needle, self::$encoding), self::$encoding);
        return ($needle === $target);
    }

    /**
     * Checks if the haystack begins with the needle (case insensitive)
     *
     * @param string $haystack
     * @param string $needle
     * @param int $offset [optional]
     * @return bool
     */
    public static function ibegins($haystack, $needle, $offset = null)
    {
        $target = mb_substr($haystack, $offset ?: 0, mb_strlen($needle, self::$encoding), self::$encoding);
        return (mb_strtolower($needle, self::$encoding) === mb_strtolower($target, self::$encoding));
    }

    /**
     * Checks if the string is not empty
     *
     * @param $string
     * @return boolean
     */
    public static function isNotEmpty($string)
    {
        if (is_string($string)) {
            return ($string !== '');
        }
        return (!empty($string));
    }

    /**
     * Returns a part of the string
     *
     * @param string $string
     *        the original string
     * @param int $start
     *        the index of first character (begins from 0)
     *        if is negative then it is index from the end of the string
     * @param string $length [optional]
     *        the length of the part string
     *        if is NULL then returns all characters to the end of the string
     *        if is negative then the length is measured from the end of the line
     * @return string
     *         the target part of the string (the empty string for invalid indexes)
     */
    public static function sub($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, self::$encoding);
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
