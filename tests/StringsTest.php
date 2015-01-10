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
        Strings::setInternalEncoding($encoding);
        $this->assertSame($encoding, Strings::getInternalEncoding());
    }

    /**
     * @var string
     */
    private $savedIntervalEncoding;
}
