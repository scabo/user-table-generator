<?php

class Scabo_Heap_Writer_Xml implements Scabo_Heap_Writer_Interface
{
    /**
     * Target for writing
     *
     * @var Scabo_Heap_Target_Interface
     */
    private $_target = null;

    /**
     * Constrictor
     *
     * @param Scabo_Heap_Target_Interface $target
     */
    public function __construct(Scabo_Heap_Target_Interface $target)
    {
        $this->setTarget($target);
    }

    /**
     * Return current target object
     *
     * @return null|Scabo_Heap_Target_Interface
     */
    function getTarget()
    {
        return $this->_target;
    }

    /**
     * Set target
     *
     * @param Scabo_Heap_Target_Interface $target
     *
     * @return Scabo_Heap_Writer_Xml
     */
    function setTarget(Scabo_Heap_Target_Interface $target)
    {
        $this->_target = $target;
        return $this;
    }

    /**
     * Write data to target as xml
     *
     * @param array         $data
     * @param string        $name
     * @param null|stirng   $group
     *
     * @return void
     */
    public function write(array $data, $name, $group = null)
    {
        $xml = new SimpleXMLElement('<root></root>');
        $this->arrayToXml($data, $xml);
        $this->getTarget()->put($xml->saveXML(), $name, $group);
    }

    /**
     * Convert assoc array to SimpleXMLElement object.
     * Fill data in $element. Also support recursive loop
     *
     * @param array            $array
     * @param SimpleXMLElement $element
     * @param string           $numericIndex
     */
    private function arrayToXml(
            array $array, SimpleXMLElement $element, $numericIndex = "item"
        )
    {
        //looping data
        foreach ($array as $key => $value) {
            //if current value is array call this method recursively
            if (is_array($value)) {

                if (!is_numeric($key)) {
                    $this->arrayToXml($value, $element->addChild($key));
                } else {
                    $this->arrayToXml($value, $element->addChild($numericIndex));
                }

            } else {
                $element->addChild($key, $value);
            }


        }
    }
}