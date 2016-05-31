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
    const TRAK = "trak";

    
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

        self::$boxTable[self::FREE] = new \ReflectionClass("\Isolator\Boxes\Free");
        self::$boxTable[self::FTYP] = new \ReflectionClass("\Isolator\Boxes\Ftyp");
        self::$boxTable[self::MDAT] = new \ReflectionClass("\Isolator\Boxes\Mdat");
        self::$boxTable[self::MOOV] = new \ReflectionClass("\Isolator\Boxes\Moov");
        self::$boxTable[self::MVHD] = new \ReflectionClass("\Isolator\Boxes\Mvhd");
        self::$boxTable[self::TRAK] = new \ReflectionClass("\Isolator\Boxes\Trak");
        
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

    public function displayDetailedBoxMap(){
        
        $this->displayBoxMap();
        
    }
    
    protected function getDepth(){
        
        if($this->container == null){
            return 1;
        }else{
            return 1 + $this->container->getDepth();
        }
        
    }
    
}

Box::__init__();
