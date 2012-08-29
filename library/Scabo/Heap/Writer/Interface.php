<?php

/**
 * Interface of the result writer
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
interface Scabo_Heap_Writer_Interface
{
    /**
     * Returns target class for this writer
     *
     * @abstract
     * @return Scabo_Heap_Target_Interface
     */
    function getTarget();

    /**
     * Set taget object for this writer
     *
     * @abstract
     *
     * @param Scabo_Heap_Target_Interface $target
     *
     * @return mixed
     */
    function setTarget(Scabo_Heap_Target_Interface $target);

    /**
     * Write data as name and group
     *
     * @abstract
     *
     * @param array         $data
     * @param string        $name
     * @param null|string   $group
     *
     * @return mixed
     */
    function write(array $data, $name, $group = null);
}