<?php

namespace Flare;

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
        self::FREE => "\Flare\Boxes\Free",
        self::FTYP => "\Flare\Boxes\Ftyp",
        self::MDAT => "\Flare\Boxes\Mdat",
        self::MOOV => "\Flare\Boxes\Moov",
        self::MVHD => "\Flare\Boxes\Mvhd",
        self::TRAK => "\Flare\Boxes\Trak",
        self::TKHD => "\Flare\Boxes\Tkhd",
        self::MDIA => "\Flare\Boxes\Mdia",
        self::MDHD => "\Flare\Boxes\Mdhd",
        self::HDLR => "\Flare\Boxes\Hdlr",
        self::MINF => "\Flare\Boxes\Minf",
        self::SMHD => "\Flare\Boxes\Smhd",
        self::DINF => "\Flare\Boxes\Dinf",
        self::DREF => "\Flare\Boxes\Dref",
        self::URL => "\Flare\Boxes\Url",
        self::URN => "\Flare\Boxes\Urn",
        self::STBL => "\Flare\Boxes\Stbl",
        self::STSD => "\Flare\Boxes\Stsd",
        self::STTS => "\Flare\Boxes\Stts",
        self::STSC => "\Flare\Boxes\Stsc",
        self::STSZ => "\Flare\Boxes\Stsz",
        self::STCO => "\Flare\Boxes\Stco",
        self::EDTS => "\Flare\Boxes\Edts",
        self::ELST => "\Flare\Boxes\Elst",
        self::PDIN => "\Flare\Boxes\Pdin",
        self::MOOF => "\Flare\Boxes\Moof",
        self::MFRA => "\Flare\Boxes\Mfra",
        self::SKIP => "\Flare\Boxes\Skip",
        self::META => "\Flare\Boxes\Meta",
        self::MECO => "\Flare\Boxes\Meco",
        self::STYP => "\Flare\Boxes\Styp",
        self::SIDX => "\Flare\Boxes\Sidx",
        self::SSIX => "\Flare\Boxes\Ssix",
        self::PRFT => "\Flare\Boxes\Prft",
        self::MVEX => "\Flare\Boxes\Mvex",
        self::MFHD => "\Flare\Boxes\Mfhd",
        self::TRAF => "\Flare\Boxes\Traf",
        self::TFRA => "\Flare\Boxes\Tfra",
        self::MFRO => "\Flare\Boxes\Mfro",
        self::UDTA => "\Flare\Boxes\Udta",
        self::ILOC => "\Flare\Boxes\Iloc",
        self::IPRO => "\Flare\Boxes\Ipro",
        self::IINF => "\Flare\Boxes\Iinf",
        self::XML => "\Flare\Boxes\Xml",
        self::BXML => "\Flare\Boxes\Bxml",
        self::PITM => "\Flare\Boxes\Pitm",
        self::FIIN => "\Flare\Boxes\Fiin",
        self::IDAT => "\Flare\Boxes\Idat",
        self::IREF => "\Flare\Boxes\Iref",
        self::MERE => "\Flare\Boxes\Mere",
        self::TREF => "\Flare\Boxes\Tref",
        self::TRGR => "\Flare\Boxes\Trgr",
        self::MEHD => "\Flare\Boxes\Mehd",
        self::LEVA => "\Flare\Boxes\Leva",
        self::TFHD => "\Flare\Boxes\Tfhd",
        self::TRUN => "\Flare\Boxes\Trun",
        self::SBGP => "\Flare\Boxes\Sbgp",
        self::SUBS => "\Flare\Boxes\Subs",
        self::SAIZ => "\Flare\Boxes\Saiz",
        self::SAIO => "\Flare\Boxes\Saio",
        self::TFDT => "\Flare\Boxes\Tfdt",
        self::CPRT => "\Flare\Boxes\Cprt",
        self::TSEL => "\Flare\Boxes\Tsel",
        self::STRK => "\Flare\Boxes\Strk",
        self::SINF => "\Flare\Boxes\Sinf",
        self::PAEN => "\Flare\Boxes\Paen",
        self::SEGR => "\Flare\Boxes\Segr",
        self::GITN => "\Flare\Boxes\Gitn",
        self::ELNG => "\Flare\Boxes\Elng",
        self::STRI => "\Flare\Boxes\Stri",
        self::STRD => "\Flare\Boxes\Strd",
        self::FRMA => "\Flare\Boxes\Frma",
        self::SCHM => "\Flare\Boxes\Schm",
        self::SCHI => "\Flare\Boxes\Schi",
        self::FIRE => "\Flare\Boxes\Fire",
        self::FPAR => "\Flare\Boxes\Fpar",
        self::FECR => "\Flare\Boxes\Fecr",
        self::VMHD => "\Flare\Boxes\Vmhd",
        self::HMHD => "\Flare\Boxes\Hmhd",
        self::STHD => "\Flare\Boxes\Sthd",
        self::NMHD => "\Flare\Boxes\Nmhd",
        self::CTTS => "\Flare\Boxes\Ctts",
        self::CSLG => "\Flare\Boxes\Cslg",
        self::STZ2 => "\Flare\Boxes\Stz2",
        self::CO64 => "\Flare\Boxes\Co64",
        self::STSS => "\Flare\Boxes\Stss",
        self::STSH => "\Flare\Boxes\Stsh",
        self::PADB => "\Flare\Boxes\Padb",
        self::STDP => "\Flare\Boxes\Stdp",
        self::SDTP => "\Flare\Boxes\Sdtp",
        self::SGPD => "\Flare\Boxes\Sgpd",
        self::ESDS => "\Flare\Boxes\Esds",
        
        //Sample Entries, might move these to a different table later
        self::MP4A => "\Flare\Boxes\SampleEntries\Mp4a"
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
            $box = new \Flare\Boxes\Unknown($file);
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
        //if($boxType == \Flare\Box::UUID) \Flare\ByteUtils::skipBytes ($file, 16);
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

            $boxSize = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Flare\ByteUtils::readBoxType($this->file);

            if ($boxSize == 1) {

                $boxSize = ByteUtils::readUnsingedLong($file);
                $newBox->setLargeSize(true);
            }
            if ($boxSize == 0)
                $toEOF = true;

            //if (array_key_exists($boxType, \Flare\Box::$boxTable)) {

                $newBox = Box::createBox($boxType, $this->file); //\Flare\Box::$boxTable[$boxType]->newInstance($this->file);
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

