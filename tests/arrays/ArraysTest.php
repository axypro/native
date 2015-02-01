<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays;

use axy\native\arrays\Arrays;
use axy\native\tests\arrays\tst\TestIterator;
use axy\native\tests\arrays\tst\TestDictionary;

/**
 * coversDefaultClass axy\native\arrays\Arrays;
 */
class ArraysTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::isNativeArray
     */
    public function testIsNativeArray()
    {
        $this->assertTrue(Arrays::isNativeArray([]));
        $this->assertTrue(Arrays::isNativeArray([1, 2, 3]));
        $this->assertFalse(Arrays::isNativeArray(new TestIterator([1, 2])));
        $this->assertFalse(Arrays::isNativeArray(new TestDictionary([1, 2])));
        $this->assertFalse(Arrays::isNativeArray((object)[1, 2, 3]));
        $this->assertFalse(Arrays::isNativeArray('string'));
    }
}
