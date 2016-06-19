<?php

namespace Flare\Boxes;

/**
 * Description of Mhd
 *
 * @author Brian Parra
 */
class Mdhd extends \Flare\FullBox {

    private $creationTime = 0;
    private $modificationTime = 0;
    private $timescale = 0;
    private $duration = 0;
    private $language = [];

    function __construct($file) {

        $this->boxType = \Flare\Box::MDHD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $internalOffset = $this->offset + $this->headerSize;
        if ($this->version == 1) {
            $this->creationTime = \Flare\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Flare\ByteUtils::readUnsignedLong($this->file);
            $this->timescale= \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Flare\ByteUtils::readUnsignedLong($this->file);
        } else {

            $this->creationTime = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->timescale= \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Flare\ByteUtils::readUnsingedInteger($this->file);
        }
        $langTemp = \Flare\ByteUtils::readBytesAsHex($this->file, 2);
        
    }
    
    public function setTimeScale($timeScale){
        $this->timescale = $timeScale;
    }

    public function setDuration($duration){
        $this->duration = $duration;
    }
    
    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Creation Time"] = $this->creationTime;
        $details["Modification Time"] = $this->modificationTime;
        $details["Time Scale"] = $this->timescale;
        $details["Duration"] = $this->duration;
        $details["Language"] = "Finish later";


        return $details;
    }

    public function writeToFile(){
        
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 32; //expand if version 1
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->creationTime);
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->modificationTime);
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->timescale);
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->duration);
        
        \Flare\ByteUtils::writeUnsignedShort($this->file, 21956); // placeholder for language
        
        \Flare\ByteUtils::padBytes($this->file, 2); //Pad 2 bytes

        
    }
}
