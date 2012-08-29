<?php

/**
 * File source
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap_Source_File implements Scabo_Heap_Source_Interface
{
    /**
     * @var string|null
     */
    private $_path = null;

    /**
     * Path to file
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->setPath($path);
    }

    /**
     * Load data from file
     *
     * @return mixed|string
     */
    public function getData()
    {
        return file_get_contents($this->getPath());
    }

    /**
     * Returns path to file
     *
     * @return null|string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Set path to file
     *
     * @param $path
     */
    public function setPath($path)
    {
        $this->_path = $path;
    }
}