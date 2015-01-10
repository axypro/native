<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests;

use axy\native\Strings;

/**
 * coversDefaultClass axy\native\Strings
 */
class StringsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->savedIntervalEncoding = Strings::getInternalEncoding();
        Strings::setInternalEncoding('UTF-8');
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        Strings::setInternalEncoding($this->savedIntervalEncoding);
    }

    /**
     * covers ::setInternalEncoding
     * covers ::getInternalEncoding
     */
    public function testIntervalEncoding()
    {
        $encoding = Strings::getInternalEncoding();
        $this->assertSame($encoding, Strings::getInternalEncoding());
        Strings::setInternalEncoding('windows-1252');
        $this->assertSame('windows-1252', Strings::getInternalEncoding());
        $this->assertSame(19, Strings::length('Это строка'));
        Strings::setInternalEncoding($encoding);
        $this->assertSame($encoding, Strings::getInternalEncoding());
    }

    /**
     * covers ::length
     * @dataProvider providerLength
     * @param string $string
     * @param int $length
     */
    public function testLength($string, $length)
    {
        $this->assertSame($length, Strings::length($string));
    }

    /**
     * @return array
     */
    public function providerLength()
    {
        return [
            ['This is string', 14],
            ['Это строка', 10],
            ['This is строка', 14],
        ];
    }

    /**
     * covers ::pos
     * @dataProvider providerPos
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testPos($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::pos($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerPos()
    {
        return [
            [0, 'раз two раз three', 'раз'],
            [4, 'раз two раз three', 'two'],
            [8, 'раз two раз three', 'раз', 1],
            [false, 'раз two раз three', 'раз', 10],
            [false, 'раз two раз three', 'four'],
            [false, 'раз two раз three', 'Раз'],
            [false, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * @var string
     */
    private $savedIntervalEncoding;
}
