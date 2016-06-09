<?php

namespace Isolator\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Mvhd extends \Isolator\FullBox {

    private $creationTime;
    private $modificationTime;
    private $timeScale;
    private $duration;
    private $rate = 65536; //0x00010000
    private $volume = 256; //0x0100 always a short
    private $matrix = [
        65536, 0, 0, 0, 65536, 0, 0, 0, 1073741824
    ]; // Unity Matrix
    private $nextTrackID = 0;

    function __construct($file) {

        $this->boxType = \Isolator\Box::MVHD;
        parent::__construct($file);
    }

    public function loadData() {

        if ($this->largeSize) {

            $this->headerSize = 16; //4 size + 4 type + 8 extended size; 
        } else {

            $this->headerSize = 8; //4 size + 4 type 
        }

        fseek($this->file, $this->offset + $this->headerSize);
        $this->version = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[0] = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[1] = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[2] = \Isolator\ByteUtils::readUnsignedByte($this->file);

        if ($this->version == 1) {
            $this->creationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->timeScale = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsignedLong($this->file);
        } else {
            $this->creationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->timeScale = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        }
    }

    public function getBoxDetails() {

        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Creation Time"] = $this->creationTime;
        $details["Modification Time"] = $this->modificationTime;
        $details["Time Scale"] = $this->timeScale;
        $details["Duration"] = $this->duration;
        

        return $details;
    }
    
    public function getCreationTime(){
        return $this->creationTime;
    }
    
    public function getModificationTime(){
        return $this->modificationTime;
    }
    
    public function getTimeScale(){
        return $this->timeScale;
    }
    
    public function getDuration(){
        return $this->duration;
    }

    public function loadDataFromBox($box) {
        $this->version = $box->getVersion();
        $this->flags = $box->getFlags();
        $this->creationTime = $box->getCreationTime();
        $this->modificationTime = $box->getModificationTime();
        $this->timeScale = $box->getTimeScale();
        $this->duration = $box->getDuration();
    }

}
