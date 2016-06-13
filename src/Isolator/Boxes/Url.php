<?php

namespace Isolator\Boxes;

/**
 * Url
 * @author Brian Parra
 */
class Url extends \Isolator\FullBox {

    
    private $location;

    function __construct($file) {

        $this->boxType = \Isolator\Box::URL;
        $this->flags[2] = 1; // For now assume location is internal
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        if ($this->flags[2] == 1) {
            $this->location = \Isolator\ByteUtils::readString($this->file, $this->size - 12);
   
        }
        
    }

    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        if ($this->flags[2] == 1) {
            $details["Location"] = "No external location";
        } else {
            $details["Location"] = $this->location;
        }


        return $details;
    }

    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        
        $this->size = 12;
        if($this->flags[2] == 0){
            $this->size += (strlen($this->name) + 1 );
        }
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        
        if ($this->flags[2] == 0) {
            \Isolator\ByteUtils::writeCString($this->file, $this->name);
   
        }
    }
}
