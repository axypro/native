<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\helpers;

class StringsHelper
{
    /**
     * Cuts a string
     *
     * @param string $string
     * @param int $maxLength
     * @param array $options [optional]
     * @param string $encoding
     * @return string
     */
    public static function cut($string, $maxLength, $options, $encoding)
    {
        $length = mb_strlen($string, $encoding);
        if ($length <= $maxLength) {
            return $string;
        }
        $length = $maxLength;
        if ($options === null) {
            $options = self::$defaultCutOptions;
        } else {
            $options = array_replace(self::$defaultCutOptions, $options);
        }
        $endLength = $options['endSingle'] ? 1 : mb_strlen($options['end'], $encoding);
        $length -= $endLength;
        if ($options['sep'] !== null) {
            return self::cutSep($string, $length, $encoding, $options);
        }
        return mb_substr($string, 0, $length, $encoding).$options['end'];

    }

    private static function cutSep($string, $length, $encoding, $options)
    {
        $sep = $options['sep'];
        if ($sep === true) {
            $sep = '/\s*\p{L}+$/u';
        }
        $string = mb_substr($string, 0, $length + 1, $encoding);
        if (!preg_match($sep, $string, $matches)) {
            return mb_substr($string, 0, -1, $encoding).$options['end'];
        }
        $cutString = $matches[0];
        $cutLength = mb_strlen($cutString, $encoding);
        $maxCut = $options['maxCut'];
        if ($maxCut === null) {
            $maxCut = min(10, floor($length / 2));
        }
        if ($cutLength > $maxCut) {
            $cutLength = $maxCut;
        }
        return mb_substr($string, 0, -$cutLength, $encoding).$options['end'];
    }

    /**
     * @var array
     */
    private static $defaultCutOptions = [
        'end' => '...',
        'endSingle' => false,
        'sep' => null,
        'maxCut' => null,
    ];
}
