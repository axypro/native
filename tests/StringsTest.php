<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests;

use axy\native\Strings;

/**
 * coversDefaultClass axy\native\Strings
 *
 * To test of multibyte strings using cyrillic characters.
 */
class StringsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        self::$savedIntervalEncoding = Strings::getInternalEncoding();
        Strings::setInternalEncoding('UTF-8');
        self::$savedMbIntervalEncoding = mb_internal_encoding();
        mb_internal_encoding('windows-1252');
    }

    /**
     * {@inheritdoc}
     */
    public static function tearDownAfterClass()
    {
        Strings::setInternalEncoding(self::$savedIntervalEncoding);
        mb_internal_encoding(self::$savedMbIntervalEncoding);
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
     * covers ::posCI
     * @dataProvider providerPosCI
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testPosCI($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::posCI($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerPosCI()
    {
        return [
            [0, 'раз two раз three', 'раз'],
            [4, 'раз two раз three', 'two'],
            [8, 'раз two раз three', 'раз', 1],
            [false, 'раз two раз three', 'раз', 10],
            [false, 'раз two раз three', 'four'],
            [0, 'раз two раз three', 'Раз'],
            [12, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * covers ::contains
     * @dataProvider providerContains
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testContains($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::contains($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerContains()
    {
        return [
            [true, 'раз two раз three', 'раз'],
            [true, 'раз two раз three', 'two'],
            [true, 'раз two раз three', 'раз', 1],
            [false, 'раз two раз three', 'раз', 10],
            [false, 'раз two раз three', 'four'],
            [false, 'раз two раз three', 'Раз'],
            [false, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * covers ::containsCI
     * @dataProvider providerContainsCI
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testContainsCI($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::containsCI($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerContainsCI()
    {
        return [
            [true, 'раз two раз three', 'раз'],
            [true, 'раз two раз three', 'two'],
            [true, 'раз two раз three', 'раз', 1],
            [false, 'раз two раз three', 'раз', 10],
            [false, 'раз two раз three', 'four'],
            [true, 'раз two раз three', 'Раз'],
            [true, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * covers ::begins
     * @dataProvider providerBegins
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testBegins($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::begins($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerBegins()
    {
        return [
            [true, 'раз two раз three', 'раз'],
            [false, 'раз two раз three', 'two'],
            [false, 'раз two раз three', 'раз', 1],
            [true, 'раз two раз three', 'раз', 8],
            [false, 'раз two раз three', 'four'],
            [false, 'раз two раз three', 'Раз'],
            [false, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * covers ::beginsCI
     * @dataProvider providerBeginsCI
     * @param int|bool $expected
     * @param string $string
     * @param string $needle
     * @param int $offset [optional]
     */
    public function testBeginsCI($expected, $string, $needle, $offset = null)
    {
        $this->assertSame($expected, Strings::beginsCI($string, $needle, $offset));
    }

    /**
     * @return array
     */
    public function providerBeginsCI()
    {
        return [
            [true, 'раз two раз three', 'раз'],
            [false, 'раз two раз three', 'two'],
            [false, 'раз two раз three', 'раз', 1],
            [true, 'раз two раз three', 'раз', 8],
            [false, 'раз two раз three', 'four'],
            [true, 'раз two раз three', 'Раз'],
            [false, 'раз two раз three', 'Three'],
        ];
    }

    /**
     * covers ::isNotEmpty
     * @dataProvider providerIsNotEmpty
     * @param bool $expected
     * @param string $string
     */
    public function testIsNotEmpty($expected, $string)
    {
        $this->assertSame($expected, Strings::isNotEmpty($string));
    }

    /**
     * @return array
     */
    public function providerIsNotEmpty()
    {
        return [
            [true, 'String'],
            [true, '0'],
            [false, ''],
            [false, null],
            [false, false],
        ];
    }

    /**
     * covers ::sub
     * @dataProvider providerSub
     * @param string $string
     * @param int $start
     * @param int $length
     * @param string $expected
     */
    public function testSub($string, $start, $length, $expected)
    {
        $this->assertSame($expected, Strings::sub($string, $start, $length));
    }

    /**
     * @return array
     */
    public function providerSub()
    {
        return [
            ['Это строка', 0, null, 'Это строка'],
            ['Это строка', 3, null, ' строка'],
            ['Это строка', 0, 5, 'Это с'],
            ['Это строка', 4, 5, 'строк'],
            ['Это строка', -8, null, 'о строка'],
            ['Это строка', -8, 5, 'о стр'],
            ['Это строка', -8, -5, 'о с'],
            ['', 5, 5, ''],
            ['Это строка', 100, null, ''],
            ['Это строка', 10, -10, ''],
            ['Это строка', -100, -8, 'Эт'],
        ];
    }

    /**
     * covers ::toLowerCase
     * covers ::toUpperCase
     * covers ::firstToUpperCase
     * covers ::wordsToUpperCase
     */
    public function testCase()
    {
        $string = 'This is strIng. Это стрОка (ёЁ).';
        $this->assertSame('this is string. это строка (ёё).', Strings::toLowerCase($string));
        $this->assertSame('THIS IS STRING. ЭТО СТРОКА (ЁЁ).', Strings::toUpperCase($string));
        $this->assertSame('This is STring.', Strings::firstToUpperCase('this is STring.'));
        $this->assertSame('ЭтО СтРока.', Strings::firstToUpperCase('этО СтРока.'));
        $this->assertSame('This Is String. Это Строка (Ёё).', Strings::wordsToUpperCase($string));
        $this->assertSame('', Strings::toLowerCase(''));
        $this->assertSame('', Strings::toUpperCase(''));
        $this->assertSame('', Strings::firstToUpperCase(''));
        $this->assertSame('', Strings::wordsToUpperCase(''));
    }

    /**
     * covers ::html
     * @dataProvider providerHtml
     * @param string $plain
     * @param bool $nl
     * @param string $expected
     */
    public function testHtml($plain, $nl, $expected)
    {
        $this->assertSame($expected, Strings::html($plain, $nl));
    }

    /**
     * @return array
     */
    public function providerHtml()
    {
        return [
            ['This is <b class="x">Строка</b>', false, 'This is &lt;b class=&quot;x&quot;&gt;Строка&lt;/b&gt;'],
            ["> one\r\n> two\n> three", false, "&gt; one\r\n&gt; two\n&gt; three"],
            ["> one\n> two\n> three", true, "&gt; one<br />\n&gt; two<br />\n&gt; three"],
        ];
    }

    /**
     * covers ::ord
     * @dataProvider providerOrd
     * @param string $char
     * @param int $expected
     */
    public function testOrd($char, $expected)
    {
        $this->assertSame($expected, Strings::ord($char));
    }

    /**
     * @return array
     */
    public function providerOrd()
    {
        return [
            ['A', 65],
            ['ё', 1105],
            [file_get_contents(__DIR__.'/tst/119072.txt'), 119072],
        ];
    }

    /**
     * covers ::chr
     * @dataProvider providerChr
     * @param string $code
     * @param int $expected
     */
    public function testChr($code, $expected)
    {
        $this->assertSame($expected, Strings::chr($code));
    }

    /**
     * @return array
     */
    public function providerChr()
    {
        return [
            [65, 'A'],
            [1105, 'ё'],
            [119072, trim(file_get_contents(__DIR__.'/tst/119072.txt'))],
        ];
    }

    /**
     * covers ::convertEncoding
     */
    public function testConvertEncoding()
    {
        $this->assertSame('A', Strings::convertEncoding('A', 'windows-1251'));
        $this->assertSame('A', Strings::convertEncoding('A', null, 'windows-1251'));
        $this->assertSame('A', Strings::convertEncoding('A'));
        $this->assertSame('и', Strings::convertEncoding('и'));
        $this->assertSame(chr(232), Strings::convertEncoding('и', 'windows-1251'));
        $this->assertSame('к', Strings::convertEncoding(chr(234), null, 'windows-1251'));
        $this->assertSame(chr(204), Strings::convertEncoding(chr(235), 'koi8-r', 'windows-1251'));
    }

    /**
     * covers ::providerCur
     * @dataProvider providerCut
     * @param string $string
     * @param int $maxLength
     * @param array $options
     * @param string $expected
     */
    public function testCut($string, $maxLength, $options, $expected)
    {
        $this->assertSame($expected, Strings::cut($string, $maxLength, $options));
    }

    /**
     * @return array
     */
    public function providerCut()
    {
        return [
            [
                'Раз. Два. Три. Четыре.',
                100,
                null,
                'Раз. Два. Три. Четыре.',
            ],
            [
                'Раз. Два. Три. Четыре.',
                10,
                null,
                'Раз. Дв...',
            ],
            [
                'Раз. Два. Три. Четыре.',
                10,
                ['end' => ''],
                'Раз. Два. ',
            ],
            [
                'Раз. Два. Три. Четыре.',
                10,
                ['end' => 'qw'],
                'Раз. Дваqw',
            ],
            [
                'Раз. Два. Три. Четыре.',
                10,
                ['end' => 'qw', 'endSingle' => true],
                'Раз. Два.qw',
            ],
            [
                'Раз. Два. Три. Четыре.',
                16,
                ['sep' => true],
                'Раз. Два. Три...',
            ],
            [
                'Раз. Два. Три. Четыре.',
                15,
                ['sep' => true],
                'Раз. Два....',
            ],
            [
                'qwertyuiop',
                8,
                ['sep' => true, 'maxCut' => 100],
                '...',
            ],
            [
                'qwertyuiop',
                8,
                ['sep' => true],
                'qwer...',
            ],
        ];
    }

    /**
     * @var string
     */
    private static $savedIntervalEncoding;

    /**
     * @var string
     */
    private static $savedMbIntervalEncoding;
}
