<?php

class Scabo_Heap_Table
{
    /**
     * Columns
     *
     * @var Scabo_Heap_Column[]
     */
    private $_columns = array();

    /**
     * Table names
     *
     * @var null|string
     */
    private $_name = null;

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->_name = (string)$name;
    }

    /**
     * Add column to table
     *
     * @param Scabo_Heap_Column $value
     *
     * @return Scabo_Heap_Table
     */
    public function attach(Scabo_Heap_Column $value)
    {
        $this->_columns[$value->getName()] = $value;

        return $this;
    }

    /**
     * Remove column from table
     *
     * @param Scabo_Heap_Column $value
     *
     * @return Scabo_Heap_Table
     */
    public function deattach(Scabo_Heap_Column $value)
    {
        unset($this->_columns[$value->getName()]);

        return $this;
    }

    /**
     * Returns table name
     *
     * @return null|string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Build random data for this table
     *
     * @param int $rowCount Count of generated row
     *
     * @return array
     */
    public function build($rowCount)
    {
        $rows = array();

        for ($i = 0; $i < $rowCount; $i++) {

            $column = array();

            foreach ($this->_columns as $value) {
                $column[$value->getName()] =
                    $this->_columns[$value->getName()]->generate();
            }

            $rows[] = $column;
        }

        return $rows;
    }
}