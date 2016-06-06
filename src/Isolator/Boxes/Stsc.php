<?php

namespace Isolator\Boxes;

/**
 * Description of Stsc
 * Sample To Chunk Box
 * @author Brian Parra
 */
class Stsc extends \Isolator\FullBox {

    private $entryCount;
    private $chunkTable;

    function __construct($file) {

        $this->boxType = \Isolator\Box::STSC;
        parent::__construct($file);
 
        
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        $this->chunkTable = [];
        for($i = 0; $i < $this->entryCount ; $i++){
            $this->chunkTable[$i] =  
                    [
                        \Isolator\ByteUtils::readUnsingedInteger($this->file) ,
                        \Isolator\ByteUtils::readUnsingedInteger($this->file),
                        \Isolator\ByteUtils::readUnsingedInteger($this->file)
                    ];
        }
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
