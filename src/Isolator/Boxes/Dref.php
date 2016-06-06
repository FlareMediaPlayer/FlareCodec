<?php

namespace Isolator\Boxes;

/**
 * Description of Dref
 *
 * @author Brian Parra
 */
class Dref extends \Isolator\FullBox {
    
    private $entryCount;
    private $dataEntries = [];

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::DREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);

     
        $this->loadChildBoxes();
        
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
}