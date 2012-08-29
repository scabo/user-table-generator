<?php

/**
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
class Scabo_Heap
{
    /**
     * Reader object
     *
     * @var Scabo_Heap_Reader_Interface
     */
    private $_reader = null;

    /**
     * Writer object
     *
     * @var Scabo_Heap_Writer_Interface
     */
    private $_writer = null;

    /**
     * Setup reader object
     *
     * @param Scabo_Heap_Reader_Interface $reader
     *
     * @return Scabo_Heap
     */
    public function setReader(Scabo_Heap_Reader_Interface $reader)
    {
        $this->_reader = $reader;

        return $this;
    }

    /**
     * Returns reader object
     *
     * @return null|Scabo_Heap_Reader_Interface
     */
    public function getReader()
    {
        return $this->_reader;
    }

    /**
     * Setup writer object
     *
     * @param Scabo_Heap_Writer_Interface $writer
     *
     * @return Scabo_Heap
     */
    public function setWriter(Scabo_Heap_Writer_Interface $writer)
    {
        $this->_writer = $writer;

        return $this;
    }

    /**
     * Returns writer object
     *
     * @return Scabo_Heap_Writer_Interface
     */
    public function getWriter()
    {
        return $this->_writer;
    }

    /**
     * Build random data
     *
     * @param array $tables List of table for which generate data.
     *  if $table is empty array data will generate for all available tables
     *
     * @return void
     */
    public function build(array $tables = array())
    {
        //Get the tables from the schema reader
        $tables = $this->_reader->getTables($tables);

        //loop tables
        foreach ($tables as $name => $table) {

            //Get total row count for table
            $total = $this->_reader->getGeneratedRow($name);

            //Get row count in piece for table
            $piece = $this->_reader->getPieceCount($name);

            //Row count in piece must be positive and less than total
            if ($piece > $total) $piece = $total;
            if ($piece <= 0) $piece = $total;

            //define quantity of the step
            $quantity = (int) ($total / $piece);

            //generate data
            for ($i = 1; $i<=$quantity; $i++) {

                $this->_writer->write(
                    $table->build($piece),
                    $table->getName(). $i
                );
            }

            //if has remainder, generate data for it
            $remainder = $total % $piece;
            if ($remainder > 0) {
                $this->_writer->write(
                    $table->build($remainder),
                    $table->getName(). ($quantity + 1)
                );
            }
        }
    }
}