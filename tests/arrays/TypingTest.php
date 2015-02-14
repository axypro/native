<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays;

use axy\native\arrays\Typing;
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
        $this->assertTrue(Typing::isNativeArray([]));
        $this->assertTrue(Typing::isNativeArray([1, 2, 3]));
        $this->assertFalse(Typing::isNativeArray(new TestIterator([1, 2])));
        $this->assertFalse(Typing::isNativeArray(new TestDictionary([1, 2])));
        $this->assertFalse(Typing::isNativeArray((object)['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertFalse(Typing::isNativeArray('string'));
    }

    /**
     * covers ::isIterator
     */
    public function testIsIterator()
    {
        $this->assertTrue(Typing::isIterator([]));
        $this->assertTrue(Typing::isIterator([1, 2, 3]));
        $this->assertTrue(Typing::isIterator(new TestIterator([1, 2])));
        $this->assertFalse(Typing::isIterator(new TestDictionary([1, 2])));
        $this->assertFalse(Typing::isIterator((object)['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertFalse(Typing::isIterator('string'));
    }

    /**
     * covers ::isDictionary
     */
    public function testIsDictionary()
    {
        $this->assertTrue(Typing::isDictionary([]));
        $this->assertTrue(Typing::isDictionary([1, 2, 3]));
        $this->assertFalse(Typing::isDictionary(new TestIterator([1, 2])));
        $this->assertTrue(Typing::isDictionary(new TestDictionary([1, 2])));
        $this->assertFalse(Typing::isDictionary((object)['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertFalse(Typing::isDictionary('string'));
    }

    /**
     * covers ::isNumeric
     */
    public function testIsNumeric()
    {
        $an = [1, 2, 3];
        $ad = ['x' => 1, 'y' => 2, 'z' => 3];
        $this->assertTrue(Typing::isNumeric($an));
        $this->assertFalse(Typing::isNumeric($ad));
        $this->assertTrue(Typing::isNumeric(new TestIterator($an)));
        $this->assertFalse(Typing::isNumeric(new TestIterator($ad)));
        $this->assertTrue(Typing::isNumeric(new TestDictionaryCountable($an)));
        $this->assertFalse(Typing::isNumeric(new TestDictionaryCountable($ad)));
        $this->assertFalse(Typing::isNumeric(new TestDictionary($an)));
        $this->assertFalse(Typing::isNumeric(new TestDictionary($ad)));
        $this->assertFalse(Typing::isNumeric((object)$an));
        $this->assertFalse(Typing::isNumeric((object)$ad));
        $this->assertFalse(Typing::isNumeric('string'));
    }

    /**
     * covers ::mustNativeArray
     */
    public function testMustNativeArray()
    {
        Typing::mustNativeArray([1, 2]);
        $message = 'Argument of mtd() must be array';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Typing::mustNativeArray(new TestIterator([1, 2]), 'mtd');
    }

    /**
     * covers ::mustIterator
     */
    public function testMustIterator()
    {
        Typing::mustIterator([1, 2]);
        Typing::mustIterator(new TestIterator([1, 2]), 'mtd');
        $message = 'Argument of mtd() must be array or Traversable';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Typing::mustIterator(new TestDictionary([1, 2]), 'mtd');
    }

    /**
     * covers ::mustDictionary
     */
    public function testMustDictionary()
    {
        Typing::mustDictionary([1, 2]);
        Typing::mustDictionary(new TestDictionary([1, 2]), 'mtd');
        $message = 'Argument of mtd() must be array or ArrayAccess';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Typing::mustDictionary(new TestIterator([1, 2]), 'mtd');
    }

    /**
     * covers ::mustNumeric
     */
    public function testMustNumeric()
    {
        Typing::mustNumeric([1, 2]);
        Typing::mustNumeric(new TestDictionaryCountable([1, 2]), 'mtd');
        Typing::mustNumeric(new TestIterator([1, 2]), 'mtd');
        $message = 'Argument of mtd() must be numeric array';
        $this->setExpectedException('axy\native\errors\ArrayTypingError', $message);
        Typing::mustNumeric(new TestDictionaryCountable(['x' => 1, 'y' => 2]), 'mtd');
    }

    /**
     * covers ::toArray
     */
    public function testToArray()
    {
        $a = ['x' => 1, 'y' => 2];
        $this->assertEquals($a, Typing::toArray($a));
        $this->assertEquals($a, Typing::toArray(new TestIterator($a)));
        $this->setExpectedException('axy\native\errors\ArrayTypingError');
        Typing::toArray(1);
    }
}
