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
    const TKHD = "tkhd";
    const MDIA = "mdia";
    const MDHD = "mdhd";
    const HDLR = "hdlr";
    const SOUN = "soun";
    const MINF = "minf";
    const SMHD = "smhd";
    const DINF = "dinf";
    const DREF = "dref";
    const URL = "url ";
    const STBL = "stbl";
    const STSD = "stsd";
    const EDSD = "edsd";
    const STTS = "stts";
    const STSC = "stsc";
    const STSZ = "stsz";
    const STCO = "stco";
    const MP4A = "mp4a";
    const EDTS = "edts";
    const ELST = "elst";
    
    
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
        self::$boxTable[self::TKHD] = new \ReflectionClass("\Isolator\Boxes\Tkhd");
        self::$boxTable[self::MDIA] = new \ReflectionClass("\Isolator\Boxes\Mdia");
        self::$boxTable[self::MDHD] = new \ReflectionClass("\Isolator\Boxes\Mdhd");
        self::$boxTable[self::HDLR] = new \ReflectionClass("\Isolator\Boxes\Hdlr");
        self::$boxTable[self::MINF] = new \ReflectionClass("\Isolator\Boxes\Minf");
        self::$boxTable[self::SMHD] = new \ReflectionClass("\Isolator\Boxes\Smhd");
        self::$boxTable[self::DINF] = new \ReflectionClass("\Isolator\Boxes\Dinf");
        self::$boxTable[self::DREF] = new \ReflectionClass("\Isolator\Boxes\Dref");
        //self::$boxTable[self::URL] = new \ReflectionClass("\Isolator\Boxes\Url");
        //self::$boxTable[self::STBL] = new \ReflectionClass("\Isolator\Boxes\Stbl");
        //self::$boxTable[self::ETSD] = new \ReflectionClass("\Isolator\Boxes\Etsd");
        //self::$boxTable[self::EDSD] = new \ReflectionClass("\Isolator\Boxes\Edsd");
        //self::$boxTable[self::STTS] = new \ReflectionClass("\Isolator\Boxes\Stts");
        //self::$boxTable[self::STSC] = new \ReflectionClass("\Isolator\Boxes\Stsc");
        //self::$boxTable[self::STSZ] = new \ReflectionClass("\Isolator\Boxes\Stsz");
        //self::$boxTable[self::STCO] = new \ReflectionClass("\Isolator\Boxes\Stco");
        //self::$boxTable[self::MP4A] = new \ReflectionClass("\Isolator\Boxes\Mp4a");
        //self::$boxTable[self::EDTS] = new \ReflectionClass("\Isolator\Boxes\Edts");
        //self::$boxTable[self::ELST] = new \ReflectionClass("\Isolator\Boxes\Elst");
        
        
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
        
        $levelPadding;
        
        for($i = 0; $i < $this->getDepth(); $i++){
            $levelPadding.= "--";
        }
        echo $levelPadding . ">";
        echo $this->boxType;
        
        foreach ($this->boxMap as $box) {
            
            echo "<div>";
            $box->displayBoxMap();
            echo "</div>";
        
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
