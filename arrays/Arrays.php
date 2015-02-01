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
     * Checks if an argument has an "array" native type
     *
     * @param mixed $a
     * @return bool
     */
    public static function isNativeArray($a)
    {
        return is_array($a);
    }

    /**
     * Checks if an argument is an iterator (an array of a Traversable object)
     *
     * @param mixed $a
     * @return bool
     */
    public static function isIterator($a)
    {
        return (is_array($a) || ($a instanceof \Traversable));
    }

    /**
     * Checks if an argument is a dictionary (an array of an ArrayAccess object)
     *
     * @param mixed $a
     * @return bool
     */
    public static function isDictionary($a)
    {
        return (is_array($a) || ($a instanceof \ArrayAccess));
    }
}
