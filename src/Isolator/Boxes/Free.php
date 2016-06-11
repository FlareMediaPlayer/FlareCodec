<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Free extends \Isolator\Box {
    
    private $freeBytes = 0;
    private $data;


    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FREE;
        parent::__construct($file);
        
    }
    
    public function setFreeBytes($freeBytes){
        $this->freeBytes = $freeBytes;
    }
    
    public function loadData() {

        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }

        $this->freeBytes = $this->size - $this->headerSize;
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Free Bytes"] = $this->freeBytes;

        return $details;
    }
    
    public function writeToFile() {
  
        $this->offset = ftell($this->file); //Save the file pointer
        //size + type 
        $this->size = 8 + $this->freeBytes;
        
        if($this->size > 4294967295){
            $totalSize += 4;
            \Isolator\ByteUtils::writeUnsignedInteger($this->file, 1); //Write the box size
            \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
            \Isolator\ByteUtils::writeUnsignedLong($this->file, $totalSize); //Write the box size
        }else{
            \Isolator\ByteUtils::writeUnsignedInteger($this->file, $totalSize); //Write the box size
            \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        }

        //This can probably be done more efficiently
        for ($i = 0; $i < $this->freeBytes; $i++) {
            \Isolator\ByteUtils::writeUnsignedByte($this->file, 0);
        }
        
    }

}
