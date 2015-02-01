<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays;

use axy\native\arrays\Arrays;
use axy\native\tests\arrays\tst\TestIterator;
use axy\native\tests\arrays\tst\TestDictionary;
use axy\native\tests\arrays\tst\TestDictionaryCountable;

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
        $this->assertFalse(Arrays::isNativeArray((object)['x' => 1, 'y' => 2, 'z' => 3]));
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
        $this->assertFalse(Arrays::isIterator((object)['x' => 1, 'y' => 2, 'z' => 3]));
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
        $this->assertFalse(Arrays::isDictionary((object)['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertFalse(Arrays::isDictionary('string'));
    }

    /**
     * covers ::isNumeric
     */
    public function testIsNumeric()
    {
        $an = [1, 2, 3];
        $ad = ['x' => 1, 'y' => 2, 'z' => 3];
        $this->assertTrue(Arrays::isNumeric($an));
        $this->assertFalse(Arrays::isNumeric($ad));
        $this->assertTrue(Arrays::isNumeric(new TestIterator($an)));
        $this->assertFalse(Arrays::isNumeric(new TestIterator($ad)));
        $this->assertTrue(Arrays::isNumeric(new TestDictionaryCountable($an)));
        $this->assertFalse(Arrays::isNumeric(new TestDictionaryCountable($ad)));
        $this->assertFalse(Arrays::isNumeric(new TestDictionary($an)));
        $this->assertFalse(Arrays::isNumeric(new TestDictionary($ad)));
        $this->assertFalse(Arrays::isNumeric((object)$an));
        $this->assertFalse(Arrays::isNumeric((object)$ad));
        $this->assertFalse(Arrays::isNumeric('string'));
    }

    /**
     * covers ::mustNativeArray
     */
    public function testMustNativeArray()
    {
        Arrays::mustNativeArray([1, 2]);
        $message = 'Argument of mtd() must be array';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Arrays::mustNativeArray(new TestIterator([1, 2]), 'mtd');
    }

    /**
     * covers ::mustIterator
     */
    public function testMustIterator()
    {
        Arrays::mustIterator([1, 2]);
        Arrays::mustIterator(new TestIterator([1, 2]), 'mtd');
        $message = 'Argument of mtd() must be array or Traversable';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Arrays::mustIterator(new TestDictionary([1, 2]), 'mtd');
    }

    /**
     * covers ::mustDictionary
     */
    public function testMustDictionary()
    {
        Arrays::mustDictionary([1, 2]);
        Arrays::mustDictionary(new TestDictionary([1, 2]), 'mtd');
        $message = 'Argument of mtd() must be array or ArrayAccess';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Arrays::mustDictionary(new TestIterator([1, 2]), 'mtd');
    }
}
