<?php

/**
 * CSV result writer
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap_Writer_Csv implements Scabo_Heap_Writer_Interface
{
    /**
     * Target object
     *
     * @var Scabo_Heap_Target_Interface
     */
    private $_target = null;

    /**
     * Constructor
     *
     * @param Scabo_Heap_Target_Interface $target
     */
    public function __construct(Scabo_Heap_Target_Interface $target)
    {
        $this->setTarget($target);
    }

    /**
     * Return target object
     *
     * @return null|Scabo_Heap_Target_Interface
     */
    function getTarget()
    {
        return $this->_target;
    }

    /**
     * Set target object
     *
     * @param Scabo_Heap_Target_Interface $target
     * @return mixed|void
     */
    function setTarget(Scabo_Heap_Target_Interface $target)
    {
        $this->_target = $target;
    }

    /**
     * Write data to the target as CSV
     *
     * @param array  $data
     * @param string $name
     * @param null   $group
     *
     * @return mixed|void
     */
    function write(array $data, $name, $group = null)
    {
        $this->getTarget()->put($this->arrayToCsv($data), $name, $group);
    }


    /**
     * Convert array to CSV
     *
     * @param array  $data
     * @param string $colDelimiter
     * @param string $rowDelimiter
     * @param string $enclosure
     *
     * @return string
     */
    private function arrayToCsv(
        array $data,
        $colDelimiter = ";",
        $rowDelimiter = "\n",
        $enclosure='"'
    )
    {
        //init result
        $result = '';

        foreach ($data as $row) {

            //row must be array
            if (!is_array($row)) continue;

            //init
            $delimiter = '';
            foreach($row as $column) {
                //apply enclosure to to cell
                $column =
                    str_replace($enclosure, "$enclosure$enclosure", $column);
                //append cell to result
                $result .= $delimiter . $enclosure . $column . $enclosure;
                $delimiter = $colDelimiter;
            }
            //close row
            $result .= $rowDelimiter;
        }

        return $result;
    }
}