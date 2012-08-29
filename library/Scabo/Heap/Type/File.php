<?php

class Scabo_Heap_Type_File implements Scabo_Heap_Type_Interface
{
    /**
     * Possible values
     *
     * @var array
     */
    private $_array = array();

    /**
     * Count of the world in generated value.
     *
     * @var int
     */
    private  $_words = 1;

    /**
     * Initialize type
     *
     * Possible values:
     *  - file - path to file with possible values
     *  - words - count of the world in generated value
     *
     * @param array $settings
     *
     * @return Scabo_Heap_Type_File
     */
    public function initialize(array $settings = array())
    {
        //init file and fill possible values from this file
        if (isset($settings['file']) && file_exists($settings['file'])) {
            $this->_array = file(
                $settings['file'],
                FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES
            );
        }

        //init words
        if (
            isset($settings['words'])
            && $settings['words'] > 1
        ) {
            $this->_words = (int)$settings['words'];
        }

        return $this;
    }

    /**
     * Generate
     *
     * @return string
     */
    public function generate()
    {
        //return null if possible values are not defined
        $count = count($this->_array);
        if (0 === $count) return;

        $result = '';

        //Build random value
        $suffix = '';
        for ($i=1; $i <= $this->_words; $i++) {
            $index = mt_rand(0, $count - 1);
            $result .= $suffix . trim($this->_array[$index]);
            $suffix = " ";
        }

        return $result;
    }
}