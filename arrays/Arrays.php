<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\arrays;

use axy\native\errors\ArrayTypingError;

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

    /**
     * Checks if an argument is an numeric array (or an array-like structure)
     *
     * @param mixed $a
     * @return bool
     */
    public static function isNumeric($a)
    {
        if (is_array($a)) {
            return (array_values($a) === $a);
        }
        if ($a instanceof \Traversable) {
            $a = iterator_to_array($a);
            return (array_values($a) === $a);
        }
        if (($a instanceof \ArrayAccess) && ($a instanceof \Countable)) {
            $count = count($a);
            for ($i = 0; $i < $count; $i++) {
                if (!isset($a[$i])) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * An argument must be an array
     *
     * @throws \axy\native\errors\ArrayTypingError
     * @param mixed $a
     * @param string $method
     */
    public static function mustNativeArray($a, $method = null)
    {
        if (!is_array($a)) {
            if ($method !== null) {
                $varName = 'Argument of '.$method.'()';
            } else {
                $varName = null;
            }
            throw new ArrayTypingError($varName, 'a');
        }
    }

    /**
     * An argument must be an iterator
     *
     * @throws \axy\native\errors\ArrayTypingError
     * @param mixed $a
     * @param string $method
     */
    public static function mustIterator($a, $method = null)
    {
        if (!self::isIterator($a)) {
            if ($method !== null) {
                $varName = 'Argument of '.$method.'()';
            } else {
                $varName = null;
            }
            throw new ArrayTypingError($varName, 'i');
        }
    }

    /**
     * An argument must be a dictionary
     *
     * @throws \axy\native\errors\ArrayTypingError
     * @param mixed $a
     * @param string $method
     */
    public static function mustDictionary($a, $method = null)
    {
        if (!self::isDictionary($a)) {
            if ($method !== null) {
                $varName = 'Argument of '.$method.'()';
            } else {
                $varName = null;
            }
            throw new ArrayTypingError($varName, 'd');
        }
    }

    /**
     * An argument must be a numeric array
     *
     * @throws \axy\native\errors\ArrayTypingError
     * @param mixed $a
     * @param string $method
     */
    public static function mustNumeric($a, $method = null)
    {
        if (!self::isNumeric($a)) {
            if ($method !== null) {
                $varName = 'Argument of '.$method.'()';
            } else {
                $varName = null;
            }
            throw new ArrayTypingError($varName, 'numeric array');
        }
    }

    /**
     * Converts an argument to native array
     *
     * @throws \axy\native\errors\ArrayTypingError
     *         the value can not be converted into an array
     * @param (array|\Traversable) $a
     * @return array
     */
    public static function toArray($a)
    {
        if (is_array($a)) {
            return $a;
        }
        if ($a instanceof \Traversable) {
            return iterator_to_array($a);
        }
        throw new ArrayTypingError(null, 'i');
    }
}
