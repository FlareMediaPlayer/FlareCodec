<?php

namespace Flare\Formats\Iso;

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
        self::FREE => "\Flare\Formats\Iso\Boxes\Free",
        self::FTYP => "\Flare\Formats\Iso\Boxes\Ftyp",
        self::MDAT => "\Flare\Formats\Iso\Boxes\Mdat",
        self::MOOV => "\Flare\Formats\Iso\Boxes\Moov",
        self::MVHD => "\Flare\Formats\Iso\Boxes\Mvhd",
        self::TRAK => "\Flare\Formats\Iso\Boxes\Trak",
        self::TKHD => "\Flare\Formats\Iso\Boxes\Tkhd",
        self::MDIA => "\Flare\Formats\Iso\Boxes\Mdia",
        self::MDHD => "\Flare\Formats\Iso\Boxes\Mdhd",
        self::HDLR => "\Flare\Formats\Iso\Boxes\Hdlr",
        self::MINF => "\Flare\Formats\Iso\Boxes\Minf",
        self::SMHD => "\Flare\Formats\Iso\Boxes\Smhd",
        self::DINF => "\Flare\Formats\Iso\Boxes\Dinf",
        self::DREF => "\Flare\Formats\Iso\Boxes\Dref",
        self::URL => "\Flare\Formats\Iso\Boxes\Url",
        self::URN => "\Flare\Formats\Iso\Boxes\Urn",
        self::STBL => "\Flare\Formats\Iso\Boxes\Stbl",
        self::STSD => "\Flare\Formats\Iso\Boxes\Stsd",
        self::STTS => "\Flare\Formats\Iso\Boxes\Stts",
        self::STSC => "\Flare\Formats\Iso\Boxes\Stsc",
        self::STSZ => "\Flare\Formats\Iso\Boxes\Stsz",
        self::STCO => "\Flare\Formats\Iso\Boxes\Stco",
        self::EDTS => "\Flare\Formats\Iso\Boxes\Edts",
        self::ELST => "\Flare\Formats\Iso\Boxes\Elst",
        self::PDIN => "\Flare\Formats\Iso\Boxes\Pdin",
        self::MOOF => "\Flare\Formats\Iso\Boxes\Moof",
        self::MFRA => "\Flare\Formats\Iso\Boxes\Mfra",
        self::SKIP => "\Flare\Formats\Iso\Boxes\Skip",
        self::META => "\Flare\Formats\Iso\Boxes\Meta",
        self::MECO => "\Flare\Formats\Iso\Boxes\Meco",
        self::STYP => "\Flare\Formats\Iso\Boxes\Styp",
        self::SIDX => "\Flare\Formats\Iso\Boxes\Sidx",
        self::SSIX => "\Flare\Formats\Iso\Boxes\Ssix",
        self::PRFT => "\Flare\Formats\Iso\Boxes\Prft",
        self::MVEX => "\Flare\Formats\Iso\Boxes\Mvex",
        self::MFHD => "\Flare\Formats\Iso\Boxes\Mfhd",
        self::TRAF => "\Flare\Formats\Iso\Boxes\Traf",
        self::TFRA => "\Flare\Formats\Iso\Boxes\Tfra",
        self::MFRO => "\Flare\Formats\Iso\Boxes\Mfro",
        self::UDTA => "\Flare\Formats\Iso\Boxes\Udta",
        self::ILOC => "\Flare\Formats\Iso\Boxes\Iloc",
        self::IPRO => "\Flare\Formats\Iso\Boxes\Ipro",
        self::IINF => "\Flare\Formats\Iso\Boxes\Iinf",
        self::XML => "\Flare\Formats\Iso\Boxes\Xml",
        self::BXML => "\Flare\Formats\Iso\Boxes\Bxml",
        self::PITM => "\Flare\Formats\Iso\Boxes\Pitm",
        self::FIIN => "\Flare\Formats\Iso\Boxes\Fiin",
        self::IDAT => "\Flare\Formats\Iso\Boxes\Idat",
        self::IREF => "\Flare\Formats\Iso\Boxes\Iref",
        self::MERE => "\Flare\Formats\Iso\Boxes\Mere",
        self::TREF => "\Flare\Formats\Iso\Boxes\Tref",
        self::TRGR => "\Flare\Formats\Iso\Boxes\Trgr",
        self::MEHD => "\Flare\Formats\Iso\Boxes\Mehd",
        self::LEVA => "\Flare\Formats\Iso\Boxes\Leva",
        self::TFHD => "\Flare\Formats\Iso\Boxes\Tfhd",
        self::TRUN => "\Flare\Formats\Iso\Boxes\Trun",
        self::SBGP => "\Flare\Formats\Iso\Boxes\Sbgp",
        self::SUBS => "\Flare\Formats\Iso\Boxes\Subs",
        self::SAIZ => "\Flare\Formats\Iso\Boxes\Saiz",
        self::SAIO => "\Flare\Formats\Iso\Boxes\Saio",
        self::TFDT => "\Flare\Formats\Iso\Boxes\Tfdt",
        self::CPRT => "\Flare\Formats\Iso\Boxes\Cprt",
        self::TSEL => "\Flare\Formats\Iso\Boxes\Tsel",
        self::STRK => "\Flare\Formats\Iso\Boxes\Strk",
        self::SINF => "\Flare\Formats\Iso\Boxes\Sinf",
        self::PAEN => "\Flare\Formats\Iso\Boxes\Paen",
        self::SEGR => "\Flare\Formats\Iso\Boxes\Segr",
        self::GITN => "\Flare\Formats\Iso\Boxes\Gitn",
        self::ELNG => "\Flare\Formats\Iso\Boxes\Elng",
        self::STRI => "\Flare\Formats\Iso\Boxes\Stri",
        self::STRD => "\Flare\Formats\Iso\Boxes\Strd",
        self::FRMA => "\Flare\Formats\Iso\Boxes\Frma",
        self::SCHM => "\Flare\Formats\Iso\Boxes\Schm",
        self::SCHI => "\Flare\Formats\Iso\Boxes\Schi",
        self::FIRE => "\Flare\Formats\Iso\Boxes\Fire",
        self::FPAR => "\Flare\Formats\Iso\Boxes\Fpar",
        self::FECR => "\Flare\Formats\Iso\Boxes\Fecr",
        self::VMHD => "\Flare\Formats\Iso\Boxes\Vmhd",
        self::HMHD => "\Flare\Formats\Iso\Boxes\Hmhd",
        self::STHD => "\Flare\Formats\Iso\Boxes\Sthd",
        self::NMHD => "\Flare\Formats\Iso\Boxes\Nmhd",
        self::CTTS => "\Flare\Formats\Iso\Boxes\Ctts",
        self::CSLG => "\Flare\Formats\Iso\Boxes\Cslg",
        self::STZ2 => "\Flare\Formats\Iso\Boxes\Stz2",
        self::CO64 => "\Flare\Formats\Iso\Boxes\Co64",
        self::STSS => "\Flare\Formats\Iso\Boxes\Stss",
        self::STSH => "\Flare\Formats\Iso\Boxes\Stsh",
        self::PADB => "\Flare\Formats\Iso\Boxes\Padb",
        self::STDP => "\Flare\Formats\Iso\Boxes\Stdp",
        self::SDTP => "\Flare\Formats\Iso\Boxes\Sdtp",
        self::SGPD => "\Flare\Formats\Iso\Boxes\Sgpd",
        self::ESDS => "\Flare\Formats\Iso\Boxes\Esds",
        
        //Sample Entries, might move these to a different table later
        self::MP4A => "\Flare\Formats\Iso\Boxes\SampleEntries\Mp4a"
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
            $box = new \Flare\Formats\Iso\Boxes\Unknown($file);
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
        $boxSize = \Flare\Common\ByteUtils::readUnsingedInteger($file);
        $boxType = \Flare\Common\ByteUtils::readBoxType($file);
        


        //UUID's not yet supported, skip for now
        //if($boxType == \Flare\Box::UUID) \Flare\Common\ByteUtils::skipBytes ($file, 16);
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

            $boxSize = \Flare\Common\ByteUtils::readUnsingedInteger($this->file);
            $boxType = \Flare\Common\ByteUtils::readBoxType($this->file);

            if ($boxSize == 1) {

                $boxSize = \Flare\Common\ByteUtils::readUnsingedLong($file);
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

