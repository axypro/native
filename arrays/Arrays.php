<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\arrays;

/**
 * Common array functions
 */
class Arrays
{
    /**
     * Checks if an argument has a "array" native type
     *
     * @param mixed $a
     * @return bool
     */
    public static function isNativeArray($a)
    {
        return is_array($a);
    }
}
