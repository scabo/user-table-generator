<?php

/**
 * Increment type
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap_Type_Increment implements Scabo_Heap_Type_Interface
{
    /**
     * Current value
     *
     * @var int
     */
    private $_current = 1;

    /**
     * Increment step
     *
     * @var int
     */
    private $_step = 1;

    /**
     * Initialize type
     *
     * Possible keys:
     *  - step Increment step
     *  - start Start value for increment
     *
     * @param array $settings
     *
     * @return Scabo_Heap_Type_Increment|void
     */
    public function initialize(array $settings = array())
    {
        //init step
        if (
            isset($settings['step'])
            && is_int($settings['step'])
        ) {
            $this->_step = $settings['step'];
        }

        //init start
        if (
            isset($settings['start'])
            && is_int($settings['start'])
        ) {
            $this->_current = $settings['start'];
        }

        return $this;
    }

    /**
     * Generate increment value
     *
     * @return int
     */
    public function generate()
    {
        $result = $this->_current;
        $this->_current += $this->_step;

        return $result;
    }
}