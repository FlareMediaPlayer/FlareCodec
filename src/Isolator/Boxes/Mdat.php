<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Mdat extends \Isolator\Box {
    
    private $data;
    private $dataBytes;
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {

        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }

        $this->dataBytes = $this->size - $this->headerSize;
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Data Bytes"] = $this->dataBytes;

        return $details;
    }
    
    public function prepareForWriting(){
        $this->offset = ftell($this->file); //Save the file pointer
        $this->headerSize = 8;
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
    }
    
    public function finalizeWriting(){
        
        $mdatEnd = ftell($this->file); // Save the current position
        $this->size = $mdatEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $mdatEnd); //Finally put the file pointer back at the end of the file
        $this->dataBytes = $this->size - $this->headerSize;
    }

}