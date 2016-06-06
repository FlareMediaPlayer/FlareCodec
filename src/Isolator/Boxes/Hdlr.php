<?php

namespace Isolator\Boxes;

/**
 * Description of Hdlr
 *
 * @author Brian Parra
 */
class Hdlr extends \Isolator\FullBox {

    //ISO BMFF 
    const VIDE = "vide";
    const SOUN = "soun";
    const HINT = "hint";
    const META = "meta";
    const NULL_HANDLER = "null";
    //MP4 types
    const ODSM = "odsm";
    const CRSM = "crsm"; //crsm
    const SDSM = "sdsm"; //sdsm
    const M7SM = "m7sm"; //m7sm
    const OCSM = "ocsm"; //ocsm
    const IPSM = "ipsm"; //ipsm
    const MJSM = "mjsm"; //mjsm

    private $handlerType;
    private $name;

    function __construct($file) {

        $this->boxType = \Isolator\Box::HDLR;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        \Isolator\ByteUtils::skipBytes($this->file, 4);
        $this->handlerType = \Isolator\ByteUtils::read4Char($this->file);
        \Isolator\ByteUtils::skipBytes($this->file, 12);
        
        //Get exact number of characters to read to prevent any malicious out of bounds reading
        $internalOffset = ftell($this->file);
        $chars = $this->size - ($internalOffset - $this->offset) - 1;
        
        //String should be equal to the current read postition minus the length;
        $this->name = \Isolator\ByteUtils::readString($this->file, $chars);
    }

    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Handler Type"] = $this->handlerType;
        $details["Name"] = $this->name;



        return $details;
    }

}
