<?php

namespace Flare\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Mvhd extends \Flare\FullBox {

    private $creationTime = 0;
    private $modificationTime = 0;
    private $timeScale = 1000;
    private $duration = 0;
    private $rate = 1; //0x00010000
    private $volume = 1; //0x0100 always a short
    private $matrix = [
        65536, 0, 0, 0, 65536, 0, 0, 0, 1073741824
    ]; // Unity Matrix
    private $nextTrackID = 1;

    function __construct($file) {

        $this->boxType = \Flare\Box::MVHD;
        parent::__construct($file);
    }

    public function loadData() {

        if ($this->largeSize) {

            $this->headerSize = 16; //4 size + 4 type + 8 extended size; 
        } else {

            $this->headerSize = 8; //4 size + 4 type 
        }

        fseek($this->file, $this->offset + $this->headerSize);
        $this->version = \Flare\ByteUtils::readUnsignedByte($this->file);
        $this->flags[0] = \Flare\ByteUtils::readUnsignedByte($this->file);
        $this->flags[1] = \Flare\ByteUtils::readUnsignedByte($this->file);
        $this->flags[2] = \Flare\ByteUtils::readUnsignedByte($this->file);

        if ($this->version == 1) {
            $this->creationTime = \Flare\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Flare\ByteUtils::readUnsignedLong($this->file);
            $this->timeScale = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Flare\ByteUtils::readUnsignedLong($this->file);
        } else {
            $this->creationTime = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->timeScale = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Flare\ByteUtils::readUnsingedInteger($this->file);
        }
        
        $this->rate = \Flare\ByteUtils::readFixedPoint16_16($this->file);
        $this->volume = \Flare\ByteUtils::readFixedPoint8_8($this->file);
        \Flare\ByteUtils::skipBytes($this->file, 10);
        $this->readMatrix();
        \Flare\ByteUtils::skipBytes($this->file, 4*6);
        $this->nextTrackID = \Flare\ByteUtils::readUnsingedInteger($this->file);
        
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
        $details["Rate"] = $this->rate;
        $details["Volume"] = $this->volume;
        $details["Matrix"] = $this->matrix;
        $details["Next Track ID"] = $this->nextTrackID;
        

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
    
    public function setNextTrackID($ID){
        $this->nextTrackID = $ID;
    }

    public function loadDataFromBox($box) {
        $this->version = $box->getVersion();
        $this->flags = $box->getFlags();
        $this->creationTime = $box->getCreationTime();
        $this->modificationTime = $box->getModificationTime();
        $this->timeScale = $box->getTimeScale();
        $this->duration = $box->getDuration();
    }

    public function writeToFile() {
        //Only for version == 0 for now
        $this->offset = ftell($this->file); //Save the file pointer
        $this->headerSize = 12;
        $this->size = 108;//count up all the fields
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
       
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->creationTime); //Write the creation time
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->modificationTime); //Write the creation time
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->timeScale); //Write the timeScale
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->duration); //Write the duration //28 bytes
        
        \Flare\ByteUtils::writeFixed16_16($this->file, $this->rate); //Later Change this to the fixed point - 32 Bytes
        
        \Flare\ByteUtils::writeFixed8_8($this->file, $this->volume); //34 bytes
        \Flare\ByteUtils::padBytes($this->file, 10); //44 bytes
        //+3 
        
        $this->writeMatrix(); // 80 bytes
         
        
        \Flare\ByteUtils::padBytes($this->file, 4*6); //104
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->nextTrackID); //108
        

        
    }
    
    protected function readMatrix() {
        for ($i = 0; $i < 9; $i++) {
            $this->matrix[$i] = \Flare\ByteUtils::readUnsingedInteger($this->file);
        }
    }
    
    protected function writeMatrix(){
        for ($i = 0; $i < 9; $i++) {
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->matrix[$i]);
        }
    }
    
    public function setDuration($duration){
        $this->duration = $duration;
    }
}
