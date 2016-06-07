<?php

namespace Isolator\Boxes;

/**
 * Description of Stsd
 *
 * @author Brian Parra
 */
class Stsd extends \Isolator\FullBox {
    
    private $entryCount;

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STSD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        $this->loadChildBoxes(null, $this->entryCount);
    }
    
    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Entry Count"] = $this->entryCount;

        


        return $details;
    }
    
    public function isAudioTrack(){
        
        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\SampleEntries\AudioSampleEntry) {
                return true;
            }
        }
        return false;
    }

}