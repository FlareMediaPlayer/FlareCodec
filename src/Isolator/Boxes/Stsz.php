<?php

namespace Isolator\Boxes;

/**
 * Description of Stsz
 *
 * @author Brian Parra
 */
class Stsz extends \Isolator\FullBox {
    
    private $sampleSize;
    private $sampleCount;
    private $sampleSizeTable;
    
    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STSZ;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
        $this->readHeader();
        $this->sampleSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        $this->sampleCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        if($this->sampleSize ==0){
            for($i = 0; $i< $this->sampleCount; $i++){
                $this->sampleSizeTable[] = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            }
        }
        
    }
    
    public function getSampleSizeTable(){
        return $this->sampleSizeTable;
    }
    
    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Sample Size"] = $this->sampleSize;
        $details["Sample Count"] = $this->sampleCount;
  
        return $details;
        
    }

}