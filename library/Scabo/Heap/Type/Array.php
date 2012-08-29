<?php

class Scabo_Heap_Type_Array implements Scabo_Heap_Type_Interface
{
    /**
     * Possible values
     *
     * @var array
     */
    private $_array = array();

    /**
     * Init
     *
     * Possible values:
     *  - items - possible values
     *
     * @param array $settings
     *
     * @return Scabo_Heap_Type_Array
     */
    public function initialize(array $settings = array())
    {
        //if items is string, puts it in empty array, so
        //predefined array contains single value
        if (is_string($settings['items'])) {
            $settings['items'] = array($settings['items']);
        }

        //init predefined array
        if (isset($settings['items']) && is_array($settings['items'])) {
            $this->_array = $settings['items'];
        }

        return $this;
    }

    /**
     * Get random value from predefined arrays
     *
     * @return mixed
     */
    public function generate()
    {
        //return null if possible values not defined
        $count = count($this->_array);
        if (0 === $count) return;

        $index = mt_rand(0, $count - 1);

        return $this->_array[$index];
    }
}