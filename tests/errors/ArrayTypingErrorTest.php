<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\errors;

use axy\native\errors\ArrayTypingError;

/**
 * coversDefaultClass axy\native\errors\ArrayTypingError
 */
class ArrayTypingErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerError
     * @param string $varName
     * @param string $tExpected
     * @param string $mExpected
     */
    public function testError($varName, $tExpected, $mExpected)
    {
        $ep = new \LogicException('message');
        $e = new ArrayTypingError($varName, $tExpected, $ep);
        $this->assertSame($mExpected, $e->getMessage());
        $this->assertSame($ep, $e->getPrevious());
    }

    /**
     * @return array
     */
    public function providerError()
    {
        return [
            [
                null,
                null,
                'Argument must be array',
            ],
            [
                'x',
                'int',
                'x must be int',
            ],
            [
                'x',
                'a',
                'x must be array',
            ],
            [
                'var',
                'i',
                'var must be array or Traversable',
            ],
            [
                null,
                'd',
                'Argument must be array or ArrayAccess',
            ],
        ];
    }
}
