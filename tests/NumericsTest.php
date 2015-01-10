<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests;

use axy\native\Numerics;

/**
 * coversDefaultClass axy\native\Numerics
 */
class NumericsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::toInt
     * @dataProvider providerToInt
     * @param string $string
     * @param int|null $expected
     */
    public function testToInt($string, $expected)
    {
        $this->assertSame($expected, Numerics::toInt($string));
    }

    /**
     * @return array
     */
    public function providerToInt()
    {
        return [
            ['', null],
            ['String', null],
            ['+0123.45e6', null],
            ['0b10100111001', null],
            ['123.45', null],
            ['-200', -200],
            ['+200', null],
            ['0200', null],
            ['0', 0],
            ['200', 200],
            ['2000000123', 2000000123],
        ];
    }

    /**
     * covers ::toUInt
     * @dataProvider providerToUInt
     * @param string $string
     * @param int|null $expected
     */
    public function testToUInt($string, $expected)
    {
        $this->assertSame($expected, Numerics::toUInt($string));
    }

    /**
     * @return array
     */
    public function providerToUInt()
    {
        return [
            ['', null],
            ['String', null],
            ['+0123.45e6', null],
            ['0b10100111001', null],
            ['123.45', null],
            ['-200', null],
            ['+200', null],
            ['0200', null],
            ['0', 0],
            ['200', 200],
            ['2000000123', 2000000123],
        ];
    }

    /**
     * covers ::toID
     * @dataProvider providerToID
     * @param string $string
     * @param int|null $expected
     */
    public function testToID($string, $expected)
    {
        $this->assertSame($expected, Numerics::toID($string));
    }

    /**
     * @return array
     */
    public function providerToID()
    {
        return [
            ['', null],
            ['String', null],
            ['+0123.45e6', null],
            ['0b10100111001', null],
            ['123.45', null],
            ['-200', null],
            ['+200', null],
            ['0200', null],
            ['0', null],
            ['200', 200],
            ['2000000123', 2000000123],
        ];
    }
}
