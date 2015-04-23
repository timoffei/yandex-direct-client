<?php
namespace YandexDirectClient;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * Common response from Yandex Direct API
 * @author Bubnov Mihail <bubnov.mihail@gmail.com>.
 */

class Response implements \ArrayAccess, \Countable, \Iterator
{
    /**
     * An array containing the entries of this collection.
     *
     * @var array
     */
    private $elements;
    
    static public function isAssoc($data)
    {
       return array_keys($data) !== range(0, count($data) - 1);
    }
    
    public function __construct(array $elements = array()) 
    {
        $this->elements = $elements;
    }
    
    public function __call($name, $arguments) {
        if(preg_match('/^get(.*)/', $name, $match)){
            if(array_key_exists($match[1], $this->elements)){
                return $this->elements[$match[1]];
            }
        }
        
        throw new ClientErrorException('Unknown method "' . $name . '"');
    }
    
    /**
     * Get element by index
     * @param Integer $index
     * @return type
     */
    public function get($index) 
    {
        return $this->elements[$index];
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->elements[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->elements[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }

    public function count() 
    {
        return count($this->elements);
    }

    public function current() 
    {
        return current($this->elements);
    }

    public function key() 
    {
        return key($this->elements);
    }

    public function next() 
    {
        return next($this->elements);
    }

    public function rewind() 
    {
        return reset($this->elements);
    }

    public function valid() 
    {
        $key = key($this->elements);
        return ($key !== NULL && $key !== FALSE);
    }

}