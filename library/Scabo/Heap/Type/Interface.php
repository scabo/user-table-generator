<?php

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
