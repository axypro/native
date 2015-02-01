<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays\tst;

class TestDictionary implements \ArrayAccess
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
    public function offsetExists($offset)
    {
        return isset($this->a[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->a[$offset]) ? $this->a[$offset] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->a[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->a[$offset]);
    }

    /**
     * @var array
     */
    protected $a;
}
