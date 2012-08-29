<?php

class Scabo_Tool_Generator
{
    const SETTINGS_FILE     = 'settings-file';
    const SETTINGS_FORMAT   = 'settings-format';
    const OUTPUT_DIR        = 'output-dir';
    const OUTPUT_FORMAT     = 'output-format';

    /**
     * @var Zend_Console_Getopt
     */
    private $_opts = null;

    /**
     * @throws Zend_Console_Getopt_Exception
     */
    public function run()
    {
        // Check the required options and if user did not enter the all
        // needed options will throw exception
        if (true !== ($message = $this->checkRequiredOptions())) {
            throw
            new Zend_Console_Getopt_Exception(
                $message, $this->getOpts()->getUsageMessage()
            );
        }

        //Build config reader based on options
        $readerFactory = new Scabo_ObjectFactory('Scabo_Heap_Reader');
        $reader =
            $readerFactory->make(
                $this->getSettingsFormat(),
                new Scabo_Heap_Source_File($this->getSettingFile())
            );

        //Build config writer based on options
        $writerFactory = new Scabo_ObjectFactory('Scabo_Heap_Writer');
        $writer =
            $writerFactory->make(
                $this->getOutputFormat(),
                new Scabo_Heap_Target_Dir($this->getOutputDir())
            );

        //Initialize Heap object
        $heap = new Scabo_Heap();
        $heap->setReader($reader);
        $heap->setWriter($writer);

        //Build data
        $heap->build();
    }

    /**
     * Returns path to the settings file
     *
     * @return string
     * @throws Zend_Exception
     */
    public function getSettingFile()
    {
        //Get path from console option
        $settingFile = $this->getOpts()->getOption(self::SETTINGS_FILE);

        //throw exception if settings file not found
        if (!file_exists($settingFile)) {
            throw new Zend_Exception(
                sprintf("File '%s' not found", $settingFile)
            );
        }

        return $settingFile;
    }

    /**
     * Returns directory for output data
     *
     * @return string
     */
    public function getOutputDir()
    {
        return $this->getOpts()->getOption(self::OUTPUT_DIR);
    }

    /**
     * Returns settings format (e,g, xml, json)
     *
     * @return string
     */
    private function getSettingsFormat()
    {
        return $this->getOpts()->getOption(self::SETTINGS_FORMAT);
    }

    /**
     * Return output format (e,g, xml, json, csv)
     *
     * @return string
     */
    private function getOutputFormat()
    {
        return $this->getOpts()->getOption(self::OUTPUT_FORMAT);
    }

    /**
     * @return bool|string
     */
    private function checkRequiredOptions()
    {
        //Get list of the required options
        $requiredOptions = $this->getRequiredRules();

        //init error message
        $message = '';

        //check that user did pass required option
        foreach($requiredOptions as $option) {
            if (null == $this->getOpts()->getOption($option)) {
                //append error text if if needed option did not pass
                $message .=
                    sprintf("Option '%s' is require",$option) . "\n";
            }
        }

        //if all is OK return true, otherwise return error message
        return ('' === $message) ? true : $message;
    }

    /**
     * Returns current console option object
     *
     * @return Zend_Console_Getopt
     */
    private function getOpts()
    {
        if (null === $this->_opts) {
            $this->_opts = new Zend_Console_Getopt(
                $this->getRules()
            );
        }

        return $this->_opts;
    }

    /**
     * Returns the array of getopt rules
     *
     * @return array
     */
    private function getRules()
    {
        return
            array(
                self::SETTINGS_FILE . '=s' => 'Settings file',
                self::SETTINGS_FORMAT . '=s' => 'Settings file',
                self::OUTPUT_DIR . '=s' => 'Output dir',
                self::OUTPUT_FORMAT . '=s' => 'Output dir',
            );
    }

    /**
     * Returns list of the required console options
     *
     * @return array
     */
    public function getRequiredRules()
    {
        return
            array(
                self::SETTINGS_FILE,
                self::SETTINGS_FORMAT,
                self::OUTPUT_DIR,
                self::OUTPUT_FORMAT,
            );
    }
}