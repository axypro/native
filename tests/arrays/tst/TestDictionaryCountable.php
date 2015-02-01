<?php
/**
 * @package axy\native
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\native\tests\arrays\tst;

class TestDictionaryCountable extends TestDictionary implements \Countable
{
    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->a);
    }
}
