<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays\tst;

class TestIterator implements \IteratorAggregate
{
    /**
     * @param array $a [optional]
     */
    public function __construct(array $a = [])
    {
        $this->a = $a;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->a);
    }

    /**
     * @var array
     */
    private $a;
}
