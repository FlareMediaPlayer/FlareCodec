<?php

namespace Isolator;

/**
 * Description of Box
 *
 * @author Brian Parra
 */
abstract class Box {

    //Extended Type
    const UUID = "uuid";
    //Standard Part 12 Box types
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
    const CTTS = "ctts";
    const CSLG = "cslg";
    const STZ2 = "stz2";
    const CO64 = "co64";
    const STSS = "stss";
    const STSH = "stsh";
    const PADB = "padb";
    const STDP = "stdp";
    const SDTP = "sdtp";

    public static $boxTable = [];
    protected $offset;
    protected $size;
    protected $file;
    protected $container;
    protected $boxMap;
    protected $boxType;
    protected $iso;
    protected $extendedType;
    protected $headerSize;
    protected $toEOF = false;
    protected $largeSize = false;

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
        self::$boxTable[self::CTTS] = new \ReflectionClass("\Isolator\Boxes\Ctts");
        self::$boxTable[self::CSLG] = new \ReflectionClass("\Isolator\Boxes\Cslg");
        self::$boxTable[self::STZ2] = new \ReflectionClass("\Isolator\Boxes\Stz2");
        self::$boxTable[self::CO64] = new \ReflectionClass("\Isolator\Boxes\Co64");
        self::$boxTable[self::STSS] = new \ReflectionClass("\Isolator\Boxes\Stss");
        self::$boxTable[self::STSH] = new \ReflectionClass("\Isolator\Boxes\Stsh");
        self::$boxTable[self::PADB] = new \ReflectionClass("\Isolator\Boxes\Padb");
        self::$boxTable[self::STDP] = new \ReflectionClass("\Isolator\Boxes\Stdp");
        self::$boxTable[self::SDTP] = new \ReflectionClass("\Isolator\Boxes\Sdtp");
        self::$boxTable[self::SGPD] = new \ReflectionClass("\Isolator\Boxes\SGPD");
    }

    public function setOffset($offset) {

        $this->offset = $offset;
    }

    public function getOffset() {

        return $this->offset;
    }

    public function setSize($size) {

        $this->size = $size;
    }

    public function setFile($file) {

        $this->file = $file;
    }

    public abstract function loadData();

    public function displayBoxMap() {

        echo "<div>";
        for ($i = 0; $i < $this->getDepth(); $i++) {
            $levelPadding.= "--";
        }
        echo $levelPadding . ">";
        echo $this->boxType;

        foreach ($this->boxMap as $box) {

            echo "<div>";
            $box->displayDetailedBoxMap();
            echo "</div>";
        }
    }

    public function displayDetailedBoxMap() {

        $this->displayBoxMap();
    }

    public function getBoxType() {
        return $this->boxType;
    }

    public function getBoxMap() {
        return $this->boxMap;
    }

    public function getDepth() {

        if ($this->container == null) {
            return 1;
        } else {
            return 1 + $this->container->getDepth();
        }
    }

    public function getSize() {

        return $this->size;
    }

    public function setLargeSize($isLarge) {
        $this->largeSize = true;
    }

    public function addBox($box) {
        $this->boxMap[] = $box;
    }

    protected function parseBox() {
        
    }

    public function getBoxDetails() {

        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        return $details;
    }

    public static function parseTopLevelBox($file, $offset, $container) {
        $newBox;
        fseek($file, $offset);
        //Get Size
        $boxSize = ByteUtils::readUnsingedInteger($file);
        $boxType = ByteUtils::readBoxType($file);

        if ($boxSize == 1) {

            $boxSize = ByteUtils::readUnsingedLong($file);
            $newBox->setLargeSize(true);
        }
        if ($boxSize == 0)
            $toEOF = true;
        //UUID's not yet supported, skip for now
        //if($boxType == \Isolator\Box::UUID) \Isolator\ByteUtils::skipBytes ($file, 16);
        //Check if Valid addition


        if (array_key_exists($boxType, Box::$boxTable)) {

            $newBox = Box::$boxTable[$boxType]->newInstance($file);
            $newBox->setSize($boxSize);
            $newBox->setOffset($offset);
            //just use a flag to set if using 64bit size to avoid doing more tests later
            //Add container

            $container->addBox($newBox);
            //If Legit, load data
            $newBox->loadData();
        }

        return $newBox;
    }

    public function setContainer($container) {
        $this->container = $container;
    }

    public function loadChildBoxes($internalOffset) {

        $newBox;
        $boxSize;
        $boxType;
        while (($internalOffset - $this->offset ) < $this->size) {
            //Set the offset 

            fseek($this->file, $internalOffset);

            $boxSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Isolator\ByteUtils::readBoxType($this->file);

            if ($boxSize == 1) {

                $boxSize = ByteUtils::readUnsingedLong($file);
                $newBox->setLargeSize(true);
            }
            if ($boxSize == 0)
                $toEOF = true;

            if (array_key_exists($boxType, \Isolator\Box::$boxTable)) {

                $newBox = \Isolator\Box::$boxTable[$boxType]->newInstance($this->file);
                $newBox->setSize($boxSize);
                $newBox->setOffset($internalOffset);
                //just use a flag to set if using 64bit size to avoid doing more tests later
                //Add container

                $this->addBox($newBox);
                $newBox->setContainer($this);
                //If Legit, load data
                $newBox->loadData();
            }



            $internalOffset += $boxSize;
        }
    }

}

Box::__init__();
