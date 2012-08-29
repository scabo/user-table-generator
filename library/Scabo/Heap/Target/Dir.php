<?php

class Scabo_Heap_Target_Dir implements Scabo_Heap_Target_Interface
{
    /**
     * Path to directory
     *
     * @var string
     */
    private $_path = null;

    /**
     * File extension
     *
     * @var string
     */
    private $_extension = '';

    /**
     * Constructor
     *
     * @param string $path Path to directory
     */
    public function __construct($path)
    {
        $this->setPath($path);
    }

    /**
     * Return file extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->_extension;
    }

    /**
     * Set file extension
     *
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->_extension = $extension;
    }

    /**
     * Set path to directory
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->_path = $path;
    }

    /**
     * Return path to directory
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Put data to directory as file
     *
     * @param      array  $data     Data
     * @param      string $name     File name
     * @param null string $group    Sub-directory name
     *
     * @throws Exception
     */
    public function put($data, $name, $group = null)
    {
        //Define path
        $path = $this->getPath() . DIRECTORY_SEPARATOR;

        //If subdirectory if defined add it to path
        if ($group !== null) {
            $path = $group . DIRECTORY_SEPARATOR;
        }

        //if path not exists make it
        if (!is_dir($path)) {
            if (!mkdir($path)) {
                throw new Exception('Incorrect target');
            }
        }

        //put data to file in directory
        file_put_contents($path . $name . $this->getExtension(), $data);
    }
}