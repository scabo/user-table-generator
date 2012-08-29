<?php

class Scabo_Heap_Reader_Xml implements Scabo_Heap_Reader_Interface
{

    /**
     * Total count of the generated rows
     * Key is table name
     *
     * @var array
     */
    private $_counts = array();

    /**
     * Generated rows in the piece
     * Key is table name
     *
     * @var array
     */
    private $_pieces = array();

    /**
     * List of possible table objects
     *
     * @var Scabo_Heap_Table
     */
    private $_tables = array();

    /**
     * Factory for Scabo_Heap_Type_*
     *
     * @var Scabo_ObjectFactory|null
     */
    private $_typeFactory = null;

    /**
     * Constructor
     *
     * @param Scabo_Heap_Source_Interface $source
     */
    public function __construct(Scabo_Heap_Source_Interface $source)
    {
        $this->buildTables($source);
    }

    /**
     * Returns count of the generated rows for by table name
     *
     * @param string $table
     *
     * @return int
     */
    function getGeneratedRow($table)
    {
        return $this->_counts[$table];
    }

    /**
     * Returns count of the generated rows for piece by table name
     *
     * @param string $table
     *
     * @return int
     */
    function getPieceCount($table)
    {
        return $this->_pieces[$table];
    }

    /**
     * Returns table objects by names
     *
     * @param array $tables
     *
     * @return array|Scabo_Heap_Table|Scabo_Heap_Table[]
     */
    function getTables(array $tables = array())
    {
        $result = array();

        if ($tables) {
            foreach ($tables as $table) {
                $result[$table] = $this->getTable($table);
            }
        } else {
            $result = $this->_tables;
        }

        return $result;
    }

    /**
     * Returns table object by name
     *
     * @param string $table
     *
     * @return Scabo_Heap_Table
     */
    function getTable($table)
    {
        return $this->_tables[$table];
    }

    private function buildTables(Scabo_Heap_Source_Interface $source)
    {
        //reset table stack
        $this->_tables = array();

        //load data from source as xml
        $xml = simplexml_load_string($source->getData());

        //loop tables
        foreach ($xml->table as $tableElement) {

            //define table name
            $tableName = (string)$tableElement['name'];

            //init table object
            $table = new Scabo_Heap_Table($tableName);

            //define total count of generated rows for table
            $this->_counts[$tableName] = (int)$tableElement['count'];

            //define generated rows in piece for table,
            //if this value is 0, all data generate in a one piece
            $pieces = 0;
            if (
                isset($tableElement['pieces'])
                && $tableElement['pieces'] > 0
            ) {
                $pieces = $tableElement['pieces'];
            }
            $this->_pieces[$tableName] = $pieces;

            //Define column object for table
            foreach ($tableElement->cell as $columnElement) {
                $column = $this->makeColumnFromXml($columnElement);
                if ($column === null) continue;
                $table->attach($column);

            }

            $this->_tables[$tableName] = $table;
        }
    }

    /**
     * Returns factory for type object
     *
     * @return null|Scabo_ObjectFactory
     */
    private function getTypeFactory()
    {
        if (null === $this->_typeFactory) {
            $this->_typeFactory = new Scabo_ObjectFactory('Scabo_Heap_Type');
        }

        return $this->_typeFactory;
    }

    /**
     * Buid column object based on the xml data
     *
     * @param SimpleXMLElement $columnData
     *
     * @return Scabo_Heap_Column|null
     */
    private function makeColumnFromXml(SimpleXMLElement $columnData)
    {
        //try to create column object
        $type = $this->getTypeFactory()->make($columnData['type']);

        //stop execution if type not defined
        if (null === $type) return;

        //Build type settings array
        $settings = array();
        foreach ($columnData->children() as $key => $value) {
            $value = array_values((array)$value);
            $settings[$key] = $value[0];
        }

        //Init type
        $type->initialize($settings);

        //Instance column object
        $column = new Scabo_Heap_Column(
            (string)$columnData['name'],
            $type
        );

        return $column;
    }
}