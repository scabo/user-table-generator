<?php

/**
 * Date range type. Uses data range as a list of possible values
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap_Type_Range_Date implements Scabo_Heap_Type_Interface
{
    /**
     * Possible values
     *
     * @var array
     */
    private $_array = array();

    /**
     * Start of the date range
     *
     * @var string
     */
    private $_start = null;

    /**
     * End of the date range
     *
     * @var string
     */
    private $_last = null;

    /**
     * Step, By default, a one day
     *
     * @var string
     */
    private $_step = '+1 day';

    /**
     * Date format
     *
     * @var string
     */
    private $_format = 'Y/m/d';

    /**
     * Init
     *
     * Possible values:
     *  - start - start of range
     *  - last - end of range
     *  - step - step in range
     *  - format - date format
     *
     * @param array $settings
     *
     * @return Scabo_Locust_Type_Range_Date
     */
    public function initialize(array $settings = array())
    {
        //init start
        if (isset($settings['start'])) {
            $this->_start = $settings['start'];
        }

        //init end
        if (isset($settings['last'])) {
            $this->_last = $settings['last'];
        }

        //init step
        if (isset($settings['step'])) {
            $this->_step = $settings['step'];
        }

        //init format
        if (isset($settings['format'])) {
            $this->_format = $settings['format'];
        }

        $this->_array =
            $this->dateRange(
                $this->_start, $this->_last,
                $this->_step, $this->_format
            );

        return $this;
    }

    /**
     * Generate data as string from range
     *
     * @return string
     */
    public function generate()
    {
        //return null in case if possible values not defined
        $count = count($this->_array);
        if (0 === $count) return;

        $index = mt_rand(0, $count - 1);

        return $this->_array[$index];
    }

    /**
     * Build range of date
     *
     * @param string $first
     * @param string $last
     * @param string $step
     * @param string $format
     *
     * @return array
     */
    private function dateRange($first, $last, $step, $format)
    {
        //Init result
        $dates = array();

        //Convert start and end values to time
        $current = strtotime($first);
        $last = strtotime($last);

        //Build date range
        while( $current <= $last ) {

            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }

        return $dates;
    }
}