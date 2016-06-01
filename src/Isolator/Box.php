<?php

namespace Isolator;

/**
 * Description of Box
 *
 * @author Brian Parra
 */
abstract class Box {

    const FREE = "free";
    const PDIN = "pdin";
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
    const STTS = "stts";
    const STSC = "stsc";
    const STSZ = "stsz";
    const STCO = "stco";
    const MP4A = "mp4a";
    const EDTS = "edts";
    const ELST = "elst";
    const MOOF = "moof";
    const MFRA = "mfra";
    const SKIP = "skip";
    const META = "meta";
    const MECO = "meco";
    const STYP = "styp";
    const SIDX = "sidx";
    const SSIX = "ssix";
    const PRFT = "prft";
    const MVEX = "mvex";
    const MFHD = "mfhd";
    const TRAF = "traf";
    const TFRA = "tfra";
    const MFRO = "mfro";
    const UDTA = "udta";
    const ILOC = "iloc";
    const IPRO = "ipro";
    const IINF = "iinf";
    const XML = "xml ";
    const BXML = "bxml";
    const PITM = "pitm";
    const FIIN = "fiin";
    const IDAT = "idat";
    const IREF = "iref";
    const MERE = "mere";
    const TREF = "tref";
    const TRGR = "trgr";
    const MEHD = "mehd";
    const LEVA = "leva";
    const TFHD = "tfhd";
    const TRUN = "trun";
    const SBGP = "sbgp";
    const SGPD = "sgpd";
    const SUBS = "subs";
    const SAIZ = "saiz";
    const SAIO = "saio";
    const TFDT = "tfdt";
    const CPRT = "cprt";
    const TSEL = "tsel";
    const STRK = "strk";
    const SINF = "sinf";
    const PAEN = "paen";
    const SEGR = "segr";
    const GITN = "gitn";
    const ELNG = "elng";
    const STRI = "stri";
    const STRD = "strd";
    const FRMA = "frma";
    const SCHM = "schm";
    const SCHI = "schi";
    const FIRE = "fire";
    const FPAR = "fpar";
    const FECR = "fecr";
    const VMHD = "vmhd";
    const HMHD = "hmhd";
    const STHD = "sthd";
    const NMHD = "nmhd";


    
    
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
        self::$boxTable[self::STBL] = new \ReflectionClass("\Isolator\Boxes\Stbl");
        self::$boxTable[self::STSD] = new \ReflectionClass("\Isolator\Boxes\Stsd");
        self::$boxTable[self::STTS] = new \ReflectionClass("\Isolator\Boxes\Stts");
        self::$boxTable[self::STSC] = new \ReflectionClass("\Isolator\Boxes\Stsc");
        self::$boxTable[self::STSZ] = new \ReflectionClass("\Isolator\Boxes\Stsz");
        self::$boxTable[self::STCO] = new \ReflectionClass("\Isolator\Boxes\Stco");
        //self::$boxTable[self::MP4A] = new \ReflectionClass("\Isolator\Boxes\Mp4a");
        self::$boxTable[self::EDTS] = new \ReflectionClass("\Isolator\Boxes\Edts");
        self::$boxTable[self::ELST] = new \ReflectionClass("\Isolator\Boxes\Elst");
        self::$boxTable[self::PDIN] = new \ReflectionClass("\Isolator\Boxes\Pdin");
        self::$boxTable[self::MOOF] = new \ReflectionClass("\Isolator\Boxes\Moof");
        self::$boxTable[self::MFRA] = new \ReflectionClass("\Isolator\Boxes\Mfra");
        self::$boxTable[self::SKIP] = new \ReflectionClass("\Isolator\Boxes\Skip");
        self::$boxTable[self::META] = new \ReflectionClass("\Isolator\Boxes\Meta");
        self::$boxTable[self::MECO] = new \ReflectionClass("\Isolator\Boxes\MECO");
        self::$boxTable[self::STYP] = new \ReflectionClass("\Isolator\Boxes\Styp");
        self::$boxTable[self::SIDX] = new \ReflectionClass("\Isolator\Boxes\Sidx");
        self::$boxTable[self::SSIX] = new \ReflectionClass("\Isolator\Boxes\Ssix");
        self::$boxTable[self::PRFT] = new \ReflectionClass("\Isolator\Boxes\Prft");
        self::$boxTable[self::MVEX] = new \ReflectionClass("\Isolator\Boxes\Mvex");
        self::$boxTable[self::MFHD] = new \ReflectionClass("\Isolator\Boxes\Mfhd");
        self::$boxTable[self::TRAF] = new \ReflectionClass("\Isolator\Boxes\Traf");
        self::$boxTable[self::TFRA] = new \ReflectionClass("\Isolator\Boxes\Tfra");
        self::$boxTable[self::MFRO] = new \ReflectionClass("\Isolator\Boxes\Mfro");
        self::$boxTable[self::UDTA] = new \ReflectionClass("\Isolator\Boxes\Udta");
        self::$boxTable[self::ILOC] = new \ReflectionClass("\Isolator\Boxes\Iloc");
        self::$boxTable[self::IPRO] = new \ReflectionClass("\Isolator\Boxes\Ipro");
        self::$boxTable[self::IINF] = new \ReflectionClass("\Isolator\Boxes\Iinf");
        self::$boxTable[self::XML] = new \ReflectionClass("\Isolator\Boxes\Xml");
        self::$boxTable[self::BXML] = new \ReflectionClass("\Isolator\Boxes\Bxml");
        self::$boxTable[self::PITM] = new \ReflectionClass("\Isolator\Boxes\Pitm");
        self::$boxTable[self::FIIN] = new \ReflectionClass("\Isolator\Boxes\Fiin");
        self::$boxTable[self::IDAT] = new \ReflectionClass("\Isolator\Boxes\Idat");
        self::$boxTable[self::IREF] = new \ReflectionClass("\Isolator\Boxes\Iref");
        self::$boxTable[self::MERE] = new \ReflectionClass("\Isolator\Boxes\Mere");
        self::$boxTable[self::TREF] = new \ReflectionClass("\Isolator\Boxes\Tref");
        self::$boxTable[self::TRGR] = new \ReflectionClass("\Isolator\Boxes\Trgr");
        self::$boxTable[self::MEHD] = new \ReflectionClass("\Isolator\Boxes\Mehd");
        self::$boxTable[self::LEVA] = new \ReflectionClass("\Isolator\Boxes\Leva");
        self::$boxTable[self::TFHD] = new \ReflectionClass("\Isolator\Boxes\Tfhd");
        self::$boxTable[self::TRUN] = new \ReflectionClass("\Isolator\Boxes\Trun");
        self::$boxTable[self::SBGP] = new \ReflectionClass("\Isolator\Boxes\Sbgp");
        self::$boxTable[self::SUBS] = new \ReflectionClass("\Isolator\Boxes\Subs");
        self::$boxTable[self::SAIZ] = new \ReflectionClass("\Isolator\Boxes\Saiz");
        self::$boxTable[self::SAIO] = new \ReflectionClass("\Isolator\Boxes\Saio");
        self::$boxTable[self::TFDT] = new \ReflectionClass("\Isolator\Boxes\Tfdt");
        self::$boxTable[self::CPRT] = new \ReflectionClass("\Isolator\Boxes\Cprt");
        self::$boxTable[self::TSEL] = new \ReflectionClass("\Isolator\Boxes\Tsel");
        self::$boxTable[self::STRK] = new \ReflectionClass("\Isolator\Boxes\Strk");
        self::$boxTable[self::SINF] = new \ReflectionClass("\Isolator\Boxes\Sinf");
        self::$boxTable[self::PAEN] = new \ReflectionClass("\Isolator\Boxes\Paen");
        self::$boxTable[self::SEGR] = new \ReflectionClass("\Isolator\Boxes\Segr");
        self::$boxTable[self::GITN] = new \ReflectionClass("\Isolator\Boxes\Gitn");
        self::$boxTable[self::ELNG] = new \ReflectionClass("\Isolator\Boxes\Elng");
        self::$boxTable[self::STRI] = new \ReflectionClass("\Isolator\Boxes\Stri");
        self::$boxTable[self::STRD] = new \ReflectionClass("\Isolator\Boxes\Strd");
        self::$boxTable[self::FRMA] = new \ReflectionClass("\Isolator\Boxes\Frma");
        self::$boxTable[self::SCHM] = new \ReflectionClass("\Isolator\Boxes\Schm");
        self::$boxTable[self::SCHI] = new \ReflectionClass("\Isolator\Boxes\Schi");
        self::$boxTable[self::FIRE] = new \ReflectionClass("\Isolator\Boxes\Fire");
        self::$boxTable[self::FPAR] = new \ReflectionClass("\Isolator\Boxes\Fpar");
        self::$boxTable[self::FECR] = new \ReflectionClass("\Isolator\Boxes\Fecr");
        self::$boxTable[self::VMHD] = new \ReflectionClass("\Isolator\Boxes\Vmhd");
        self::$boxTable[self::HMHD] = new \ReflectionClass("\Isolator\Boxes\Hmhd");
        self::$boxTable[self::STHD] = new \ReflectionClass("\Isolator\Boxes\Sthd");
        self::$boxTable[self::NMHD] = new \ReflectionClass("\Isolator\Boxes\Nmhd");
        

    }
    

    public function setOffset($offset) {

        $this->offset = $offset;
    }
    
    public function getOffset(){
        
        return $this->offset;
                
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
