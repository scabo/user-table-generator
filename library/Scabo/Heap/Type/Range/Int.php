<?php

class Scabo_Heap_Type_Range_Int implements Scabo_Heap_Type_Interface
{
    /**
     * Possible values
     *
     * @var array
     */
    private $_array = array();

    /**
     * Init type
     * Possible values:
     *  - start - start value
     *  - step - step in range
     *  - limit - end value
     *
     * @param array $settings
     *
     * @return Scabo_Heap_Type_Range_Int
     */
    public function initialize(array $settings = array())
    {
        //set default values for start and step
        $start = 1;
        $step = 1;

        //init start
        if (isset($settings['start']) && is_int($settings['start'])) {
            $start = $settings['start'];
        }

        //init step. Step always is more zero
        if (
            isset($settings['step'])
            && $settings['step'] > 0
        ) {
            $step = $settings['step'];
        }

        //init limit. Limit must be more than (start + step)
        if (
            isset($settings['limit'])
            && $start + $step <= $settings['limit']
        ) {
            $limit = $settings['limit'];
        } else {
            $limit = $start + $step;
        }

        $this->_array = range($start, $limit, $step);

        return $this;
    }

    /**
     * Generate value from range
     *
     * @return int
     */
    public function generate()
    {
        //return null if the possible values not defined
        $count = count($this->_array);
        if (0 === $count) return;

        $index = mt_rand(0, $count - 1);
        return $this->_array[$index];
    }
}