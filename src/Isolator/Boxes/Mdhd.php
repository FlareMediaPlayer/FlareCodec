<?php

namespace Isolator\Boxes;

/**
 * Description of Mhd
 *
 * @author Brian Parra
 */
class Mdhd extends \Isolator\FullBox {

    private $creationTime = 0;
    private $modificationTime = 0;
    private $timescale = 0;
    private $duration = 0;
    private $language = [];

    function __construct($file) {

        $this->boxType = \Isolator\Box::MDHD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $internalOffset = $this->offset + $this->headerSize;
        if ($this->version == 1) {
            $this->creationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->timescale= \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsignedLong($this->file);
        } else {

            $this->creationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->timescale= \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        }
        $langTemp = \Isolator\ByteUtils::readBytesAsHex($this->file, 2);
        
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
        
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 32; //expand if version 1
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->creationTime);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->modificationTime);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->timescale);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->duration);
        
        \Isolator\ByteUtils::writeUnsignedShort($this->file, 0); // placeholder for language
        
        \Isolator\ByteUtils::padBytes($this->file, 2); //Pad 2 bytes

        
    }
}
