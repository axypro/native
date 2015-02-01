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

    /**
     * covers ::isIterator
     */
    public function testIsIterator()
    {
        $this->assertTrue(Arrays::isIterator([]));
        $this->assertTrue(Arrays::isIterator([1, 2, 3]));
        $this->assertTrue(Arrays::isIterator(new TestIterator([1, 2])));
        $this->assertFalse(Arrays::isIterator(new TestDictionary([1, 2])));
        $this->assertFalse(Arrays::isIterator((object)[1, 2, 3]));
        $this->assertFalse(Arrays::isIterator('string'));
    }

    /**
     * covers ::isDictionary
     */
    public function testIsDictionary()
    {
        $this->assertTrue(Arrays::isDictionary([]));
        $this->assertTrue(Arrays::isDictionary([1, 2, 3]));
        $this->assertFalse(Arrays::isDictionary(new TestIterator([1, 2])));
        $this->assertTrue(Arrays::isDictionary(new TestDictionary([1, 2])));
        $this->assertFalse(Arrays::isDictionary((object)[1, 2, 3]));
        $this->assertFalse(Arrays::isDictionary('string'));
    }
}
