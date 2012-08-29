<?php

/**
 * Column of the generated table
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap_Column
{
    /**
     * @var string
     */
    private $_name = null;

    /**
     * @var Scabo_Heap_Type_Interface
     */
    private $_type = null;

    /**
     * Constructor
     *
     * @param null|string               $name
     * @param Scabo_Heap_Type_Interface $type
     */
    public function Scabo_Heap_Column(
        $name = null,
        Scabo_Heap_Type_Interface $type = null
    )
    {
        $this->initialize($name, $type);
    }

    /**
     * Init column
     *
     * @param string                    $name
     * @param Scabo_Heap_Type_Interface $type
     */
    public function initialize($name, Scabo_Heap_Type_Interface $type)
    {
        $this->_name = trim((string)$name);
        $this->_type = $type;
    }

    /**
     * Return column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Generate random value
     *
     * @return mixed
     */
    public function generate()
    {
        return $this->_type->generate();
    }
}