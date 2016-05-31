<?php

namespace Isolator;

/**
 * Description of Box
 *
 * @author Brian Parra
 */


abstract class Box {
    
    const FREE = "free";
    const FTYP = "ftyp";

    public static $boxTable = [];
    
    protected $offset;
    
    protected $size;
    
    protected $file;
    
    function __construct($file){
        
        $this->file = $file;
        
    }
  

    public static function __init__() {
        
        self::$boxTable['free'] = new \ReflectionClass("\Isolator\Boxes\Free");
        self::$boxTable['ftyp'] = new \ReflectionClass("\Isolator\Boxes\Ftyp");

    }
    
    public function setOffset($offset){
        
        $this->offset = $offset;
        
    }
    
    public function setSize($size){
        
        $this->size = $size;
        
    }
    
    public function setFile($file){
        
        $this->file = $file;
        
    }


}

Box::__init__();
