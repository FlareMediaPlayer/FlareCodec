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
    private $timescale;
    private $duration;
    private $rate = 65536; //0x00010000
    private $volume = 256; //0x0100 always a short
    private $matrix = [
        65536, 0, 0, 0, 65536, 0 ,0 ,0 ,1073741824
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
    }
    
    public function getBoxDetails() {
        
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;

        return $details;
    }
    
    


}