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
    const URN = "urn ";
    const STBL = "stbl";
    const STSD = "stsd";
    const STTS = "stts";
    const STSC = "stsc";
    const STSZ = "stsz";
    const STCO = "stco";
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
    const ESDS = "esds"; //Entry Sample Descriptor
    //
    //SAMPLE ENTRIES
    const MP4A = "mp4a"; //Audio Sample Entry

    public static $boxTable = [
        self::FREE => "\Isolator\Boxes\Free",
        self::FTYP => "\Isolator\Boxes\Ftyp",
        self::MDAT => "\Isolator\Boxes\Mdat",
        self::MOOV => "\Isolator\Boxes\Moov",
        self::MVHD => "\Isolator\Boxes\Mvhd",
        self::TRAK => "\Isolator\Boxes\Trak",
        self::TKHD => "\Isolator\Boxes\Tkhd",
        self::MDIA => "\Isolator\Boxes\Mdia",
        self::MDHD => "\Isolator\Boxes\Mdhd",
        self::HDLR => "\Isolator\Boxes\Hdlr",
        self::MINF => "\Isolator\Boxes\Minf",
        self::SMHD => "\Isolator\Boxes\Smhd",
        self::DINF => "\Isolator\Boxes\Dinf",
        self::DREF => "\Isolator\Boxes\Dref",
        self::URL => "\Isolator\Boxes\Url",
        self::URN => "\Isolator\Boxes\Urn",
        self::STBL => "\Isolator\Boxes\Stbl",
        self::STSD => "\Isolator\Boxes\Stsd",
        self::STTS => "\Isolator\Boxes\Stts",
        self::STSC => "\Isolator\Boxes\Stsc",
        self::STSZ => "\Isolator\Boxes\Stsz",
        self::STCO => "\Isolator\Boxes\Stco",
        self::EDTS => "\Isolator\Boxes\Edts",
        self::ELST => "\Isolator\Boxes\Elst",
        self::PDIN => "\Isolator\Boxes\Pdin",
        self::MOOF => "\Isolator\Boxes\Moof",
        self::MFRA => "\Isolator\Boxes\Mfra",
        self::SKIP => "\Isolator\Boxes\Skip",
        self::META => "\Isolator\Boxes\Meta",
        self::MECO => "\Isolator\Boxes\Meco",
        self::STYP => "\Isolator\Boxes\Styp",
        self::SIDX => "\Isolator\Boxes\Sidx",
        self::SSIX => "\Isolator\Boxes\Ssix",
        self::PRFT => "\Isolator\Boxes\Prft",
        self::MVEX => "\Isolator\Boxes\Mvex",
        self::MFHD => "\Isolator\Boxes\Mfhd",
        self::TRAF => "\Isolator\Boxes\Traf",
        self::TFRA => "\Isolator\Boxes\Tfra",
        self::MFRO => "\Isolator\Boxes\Mfro",
        self::UDTA => "\Isolator\Boxes\Udta",
        self::ILOC => "\Isolator\Boxes\Iloc",
        self::IPRO => "\Isolator\Boxes\Ipro",
        self::IINF => "\Isolator\Boxes\Iinf",
        self::XML => "\Isolator\Boxes\Xml",
        self::BXML => "\Isolator\Boxes\Bxml",
        self::PITM => "\Isolator\Boxes\Pitm",
        self::FIIN => "\Isolator\Boxes\Fiin",
        self::IDAT => "\Isolator\Boxes\Idat",
        self::IREF => "\Isolator\Boxes\Iref",
        self::MERE => "\Isolator\Boxes\Mere",
        self::TREF => "\Isolator\Boxes\Tref",
        self::TRGR => "\Isolator\Boxes\Trgr",
        self::MEHD => "\Isolator\Boxes\Mehd",
        self::LEVA => "\Isolator\Boxes\Leva",
        self::TFHD => "\Isolator\Boxes\Tfhd",
        self::TRUN => "\Isolator\Boxes\Trun",
        self::SBGP => "\Isolator\Boxes\Sbgp",
        self::SUBS => "\Isolator\Boxes\Subs",
        self::SAIZ => "\Isolator\Boxes\Saiz",
        self::SAIO => "\Isolator\Boxes\Saio",
        self::TFDT => "\Isolator\Boxes\Tfdt",
        self::CPRT => "\Isolator\Boxes\Cprt",
        self::TSEL => "\Isolator\Boxes\Tsel",
        self::STRK => "\Isolator\Boxes\Strk",
        self::SINF => "\Isolator\Boxes\Sinf",
        self::PAEN => "\Isolator\Boxes\Paen",
        self::SEGR => "\Isolator\Boxes\Segr",
        self::GITN => "\Isolator\Boxes\Gitn",
        self::ELNG => "\Isolator\Boxes\Elng",
        self::STRI => "\Isolator\Boxes\Stri",
        self::STRD => "\Isolator\Boxes\Strd",
        self::FRMA => "\Isolator\Boxes\Frma",
        self::SCHM => "\Isolator\Boxes\Schm",
        self::SCHI => "\Isolator\Boxes\Schi",
        self::FIRE => "\Isolator\Boxes\Fire",
        self::FPAR => "\Isolator\Boxes\Fpar",
        self::FECR => "\Isolator\Boxes\Fecr",
        self::VMHD => "\Isolator\Boxes\Vmhd",
        self::HMHD => "\Isolator\Boxes\Hmhd",
        self::STHD => "\Isolator\Boxes\Sthd",
        self::NMHD => "\Isolator\Boxes\Nmhd",
        self::CTTS => "\Isolator\Boxes\Ctts",
        self::CSLG => "\Isolator\Boxes\Cslg",
        self::STZ2 => "\Isolator\Boxes\Stz2",
        self::CO64 => "\Isolator\Boxes\Co64",
        self::STSS => "\Isolator\Boxes\Stss",
        self::STSH => "\Isolator\Boxes\Stsh",
        self::PADB => "\Isolator\Boxes\Padb",
        self::STDP => "\Isolator\Boxes\Stdp",
        self::SDTP => "\Isolator\Boxes\Sdtp",
        self::SGPD => "\Isolator\Boxes\Sgpd",
        self::ESDS => "\Isolator\Boxes\Esds",
        
        //Sample Entries, might move these to a different table later
        self::MP4A => "\Isolator\Boxes\SampleEntries\Mp4a"
    ];
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
    
    public static function createBox($boxType, $file){
        
        $box;
        if (array_key_exists($boxType, Box::$boxTable)) {
            $box = new Box::$boxTable[$boxType]($file);
        }else{
            //create an unknown box
            $box = new \Isolator\Boxes\Unknown($file);
        }
        return $box;
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

    public function getFile(){
        return $this->file;
    }
    
    public function getSize(){
        return $this->size;
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



    public function setLargeSize($isLarge) {
        $this->largeSize = true;
    }

    public function addBox($box) {
        $this->boxMap[] = $box;
        $box->setContainer($this);
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
        


        //UUID's not yet supported, skip for now
        //if($boxType == \Isolator\Box::UUID) \Isolator\ByteUtils::skipBytes ($file, 16);
        //Check if Valid addition


        

            $newBox = Box::createBox($boxType, $file);// Box::$boxTable[$boxType]->newInstance($file);
            $newBox->setSize($boxSize);
            $newBox->setOffset($offset);
            //just use a flag to set if using 64bit size to avoid doing more tests later
            //Add container

            $container->addBox($newBox);
            //If Legit, load data
            $newBox->loadData();
        

        return $newBox;
    }

    public function setContainer($container) {
        $this->container = $container;
    }

    public function loadChildBoxes($internalOffset = null , $limit = INF) {
        
        if($internalOffset == NULL){
            $offset = ftell($this->file);
        }else{
            $offset = $internalOffset;
        }
        $newBox;
        $boxSize = 0;
        $boxType;
        $boxCount = 0;
        
        while (($offset - $this->offset ) < $this->size && $boxCount < $limit) {
            //Set the offset 

            fseek($this->file, $offset);

            $boxSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Isolator\ByteUtils::readBoxType($this->file);

            if ($boxSize == 1) {

                $boxSize = ByteUtils::readUnsingedLong($file);
                $newBox->setLargeSize(true);
            }
            if ($boxSize == 0)
                $toEOF = true;

            //if (array_key_exists($boxType, \Isolator\Box::$boxTable)) {

                $newBox = Box::createBox($boxType, $this->file); //\Isolator\Box::$boxTable[$boxType]->newInstance($this->file);
                $newBox->setSize($boxSize);
                $newBox->setOffset($offset);
                //just use a flag to set if using 64bit size to avoid doing more tests later
                //Add container

                $this->addBox($newBox);
                $newBox->setContainer($this);
                //If Legit, load data
                $newBox->loadData();
            //}


            $boxCount++;
            $offset += $boxSize;
        }
    }
    

    protected function readHeader(){
        
        $headerSize = 8; //4 for size, 4 for type
        if($this->size > 4294967295){
            $headerSize += 4;
        }
        
        
        fseek($this->file, $this->offset + $headerSize); //Set the read position directly after header data
        $this->headerSize = $headerSize; //Set the overall header size;
        
    }
    
    public function getBoxByClass($class){
        
        foreach($this->boxMap as $box){
            if ($box instanceof $class)
                return $box;
        }
        
        return null;
    }
    
    public function writeToFile(){
        
    }
    
    public function calculateSize(){
        return 0;
    }
    
    private function calculateHeaderSize($childBoxesSize){

    }
}

