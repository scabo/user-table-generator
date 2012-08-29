<?php

/**
 * Type of generated value
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
interface Scabo_Heap_Type_Interface
{
    /**
     * Init type
     *
     * @abstract
     * @param array $settings
     * @return void
     */
    function initialize(array $settings = array());

    /**
     * Generate random value
     *
     * @abstract
     * @return mixed
     */
    function generate();
}
