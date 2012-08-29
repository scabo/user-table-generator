<?php

interface Scabo_Heap_Reader_Interface
{
    /**
     * @abstract
     *
     * Returns total count of generated rows
     *
     * @param $table
     *
     * @return int
     */
    function getGeneratedRow($table);

    /**
     * @abstract
     *
     * Returns count of generated row on the piece
     *
     * @param string $table
     *
     * @return int
     */
    function getPieceCount($table);

    /**
     * @abstract
     *
     * Returns list of the table objects by name, if param is empty array will
     * return all possible tables
     *
     * @param array $tables Array of the table names
     *
     * @return Scabo_Heap_Table[]
     */
    function getTables(array $tables = array());

    /**
     * @abstract
     *
     * Returns table object by name
     *
     * @param string $table Table name
     *
     * @return Scabo_Heap_Table
     */
    function getTable($table);
}