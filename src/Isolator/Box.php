<?php

namespace Isolator;

/**
 * Description of Box
 *
 * @author Brian Parra
 */


abstract class Box {

    public static $boxTable = [];


    public static function __init__() {
        
        self::$boxTable['free'] = new \ReflectionClass("\Isolator\Boxes\Free");

    }


}

Box::__init__();
