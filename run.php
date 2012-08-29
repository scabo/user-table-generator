#!/usr/bin/php5
<?php

set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            realpath(dirname(__FILE__) . '/library'), get_include_path(),
        )
    )
);

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace('Zend_');
$loader->registerNamespace('Scabo_');

$generator = new Scabo_Tool_Generator();

try {
    $generator->run();
} catch (Zend_Console_Getopt_Exception $ex) {
    echo $ex->getMessage();
    exit;
} catch (Exeption $ex) {
    echo $ex->getMessage();
    exit;
}
