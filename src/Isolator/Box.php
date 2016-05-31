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
    const MDAT = "mdat";
    const MOOV = "moov";
    const MVHD = "mvhd";

    
    public static $boxTable = [];
    protected $offset;
    protected $size;
    protected $file;
    protected $container;
    protected $boxMap;
    protected $boxType;
            
    function __construct($file) {
        $this->boxMap = [];
        $this->file = $file;
    }

    public static function __init__() {

        self::$boxTable['free'] = new \ReflectionClass("\Isolator\Boxes\Free");
        self::$boxTable['ftyp'] = new \ReflectionClass("\Isolator\Boxes\Ftyp");
        self::$boxTable['mdat'] = new \ReflectionClass("\Isolator\Boxes\Mdat");
        self::$boxTable['moov'] = new \ReflectionClass("\Isolator\Boxes\Moov");
        self::$boxTable['mvhd'] = new \ReflectionClass("\Isolator\Boxes\Mvhd");
        
    }

    public function setOffset($offset) {

        $this->offset = $offset;
    }

    public function setSize($size) {

        $this->size = $size;
    }

    public function setFile($file) {

        $this->file = $file;
    }

    public abstract function loadData();

    public function displayBoxMap(){
        $levelPadding = "";
        
        for($i = 0; $i < $this->getDepth(); $i++){
            $levelPadding.= "--";
        }
        echo $levelPadding . ">";
        echo $this->boxType . PHP_EOL;
        
        foreach ($this->boxMap as $box) {
            
            $box->displayBoxMap();
        
        }
       
    }

    public abstract function displayDetailedBoxMap();
    
    protected function getDepth(){
        
        if($this->container == null){
            return 1;
        }else{
            return 1 + $this->container->getDepth();
        }
        
    }
    
}

Box::__init__();
