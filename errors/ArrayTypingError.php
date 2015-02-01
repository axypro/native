<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\errors;

use axy\errors\TypingError;

/**
 * An argument of a method must be an array or an array-like object
 */
class ArrayTypingError extends TypingError implements Error
{
    /**
     * The constructor
     *
     * @param string $varName [optional]
     * @param string $expected [optional]
     * @param \Exception $previous [optional]
     * @param mixed $thrower [optional]
     */
    public function __construct($varName = null, $expected = null, \Exception $previous = null, $thrower = null)
    {
        if ($varName === null) {
            $varName = 'Argument';
        }
        if ($expected === null) {
            $expected = 'array';
        } elseif (isset($this->expectedAbbr[$expected])) {
            $expected = $this->expectedAbbr[$expected];
        }
        parent::__construct($varName, $expected, $previous, $thrower);
    }

    /**
     * @var array
     */
    private $expectedAbbr = [
        'a' => 'array',
        'd' => 'array or ArrayAccess',
        'i' => 'array or Traversable',
    ];
}
