<?php
namespace PayConn;

use \ArrayIterator as AbstractArrayIterator;

/**
 * Class ArrayIterator
 * @package PayConn
 */
class ArrayIterator extends AbstractArrayIterator
{
    /**
     * Offset get
     * @param string $index
     * @return mixed|null
     */
    public function offsetGet($index)
    {
        if (!$this->offsetExists($index)) {
            return null;
        }
        return $this->offsetGet($index);
    }
}