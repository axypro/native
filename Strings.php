<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native;

use axy\native\helpers\StringsHelper;

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
    public static function posCI($haystack, $needle, $offset = null)
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
    public static function containsCI($haystack, $needle, $offset = null)
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
    public static function beginsCI($haystack, $needle, $offset = null)
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
     * Makes a string lowercase
     *
     * @param string $string
     * @return string
     */
    public static function toLowerCase($string)
    {
        return mb_strtolower($string, self::$encoding);
    }

    /**
     * Makes a string uppercase
     *
     * @param string $string
     * @return string
     */
    public static function toUpperCase($string)
    {
        return mb_strtoupper($string, self::$encoding);
    }

    /**
     * Makes a string's first character uppercase
     *
     * @param $string
     * @return string
     */
    public static function firstToUpperCase($string)
    {
        return self::toUpperCase(self::sub($string, 0, 1)).self::sub($string, 1);
    }

    /**
     * Makes the first character of each word uppercase (and lowercase for other)
     *
     * @param $string
     * @return string
     */
    public static function wordsToUpperCase($string)
    {
        return mb_convert_case($string, MB_CASE_TITLE, self::$encoding);
    }

    /**
     * Converts a plain text to a html code
     *
     * @param string $plain
     * @param bool $nl [optional]
     *        format line breaks
     * @return string
     */
    public static function html($plain, $nl = false)
    {
        $html = htmlspecialchars($plain, ENT_COMPAT | ENT_HTML5, self::$encoding);
        if ($nl) {
            $html = nl2br($html, true);
        }
        return $html;
    }

    /**
     * Returns an unicode code of a character
     *
     * @param string $char
     * @return int
     */
    public static function ord($char)
    {
        $charUCS = mb_convert_encoding($char, 'UCS-4BE', self::$encoding);
        $code = unpack('N', $charUCS);
        return $code[1];
    }

    /**
     * Returns a character by an unicode code
     *
     * @param int $code
     * @return string
     */
    public static function chr($code)
    {
        $charUCS = pack('N', $code);
        return mb_convert_encoding($charUCS, self::$encoding, 'UCS-4BE');
    }

    /**
     * Converts encoding of a string
     *
     * @param string $string
     *        the string in the original encoding
     * @param string $to [optional]
     *        the target encoding (by default used the internal encoding)
     * @param string $from [optional]
     *        the original encoding (by default use the internal encoding)
     * @return string
     *         the string is the target encoding
     */
    public static function convertEncoding($string, $to = null, $from = null)
    {
        return mb_convert_encoding($string, $to ?: self::$encoding, $from ?: self::$encoding);
    }

    /**
     * Cuts a string
     *
     * @param string $string
     *        the input string
     * @param int $maxLength
     *        maximum length of the result string
     * @param array $options [optional]
     *        "end" - the end of the string
     *        "endSingle" - use the end as a single character ("&hellip;" for example)
     *        "sep" - a RegExp for cut the end (by default is none, true - "/\s*\p{L}+$/u")
     *        "maxCut" - maximum cut for $sep-search (by default min[10, half length])
     * @return string
     *         the cutted string
     */
    public static function cut($string, $maxLength, array $options = null)
    {
        return StringsHelper::cut($string, $maxLength, $options, self::$encoding);
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
