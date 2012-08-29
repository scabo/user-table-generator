<?php

/**
 * Interface of the settings source
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
interface Scabo_Heap_Source_Interface
{
    /**
     * Return data from source
     *
     * @abstract
     * @return mixed
     */
    function getData();
}