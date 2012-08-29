<?php

/**
 * Interface of the result target
 *
 * @category    Scabo
 * @package     Scabo_Heap
 * @author      Sergey Sheviakov <scabo.dev@gmail.com>
 * @copyright   Copyright (c) 2012, Sergey Sheviakov
 */
interface Scabo_Heap_Target_Interface
{
    function put($name, $data, $group = null);
}