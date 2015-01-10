<?php
/**
 * @package ayx/native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native;

/**
 * Numeric strings.
 * Numeric string is the string that contains a representation of number
 */
class Numerics
{
    /**
     * Converts the string to the integer
     *
     * @param string $string
     * @return int|null
     */
    public static function toInt($string)
    {
        $result = (int)$string;
        if ((string)$result !== $string) {
            return null;
        }
        return $result;
    }

    /**
     * Converts the string to the unsigned integer (non negative)
     *
     * @param string $string
     * @return int|null
     */
    public static function toUInt($string)
    {
        $result = self::toInt($string);
        if (($result !== null) && ($result < 0)) {
            $result = null;
        }
        return $result;
    }

    /**
     * Converts the string to the positive integer (ID)
     *
     * @param string $string
     * @return int|null
     */
    public static function toID($string)
    {
        $result = self::toInt($string);
        if (($result !== null) && ($result <= 0)) {
            $result = null;
        }
        return $result;
    }
}
