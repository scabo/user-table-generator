<?php

/**
 * @category    Scabo
 * @package     Scabo_ObjectFactory
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
final class Scabo_ObjectFactory
{
    /**
     * Class prefix
     *
     * @var string
     */
    private $_prefix = '';

    /**
     * Constructor
     *
     * @param string  $prefix
     *
     * @throws InvalidArgumentException
     */
    public function __construct($prefix)
    {
        //Prefix must be string only
        if (!is_string($prefix)) {
            throw new InvalidArgumentException();
        }

        $this->_prefix = $prefix;
    }

    /**
     * Create object by name
     *
     * @param string $name
     * @return object | null
     */
    public function make($name)
    {
        //Build class name
        $className = $this->_prefix.'_'.ucfirst((string)$name);

        //Create reflection
        $class = new ReflectionClass($className);

        //get available arguments
        $args = func_get_args();

        //drop first argument - value of $name
        unset($args[0]);

        //instance class with args
        return $class->newInstanceArgs($args);
    }
}