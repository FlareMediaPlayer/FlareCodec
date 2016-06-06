<?php

namespace Isolator\Boxes;

/**
 * Description of Stsd
 * Time To Sample Box
 * @author Brian Parra
 */
class Stts extends \Isolator\FullBox {
    
    private $entryCount;
    private $deltaTable;

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STTS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
        $this->readHeader();
        $this->entryCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        $this->deltaTable = [];
        for($i = 0; $i < $this->entryCount ; $i++){
            $this->deltaTable[$i] =  
                    [
                        \Isolator\ByteUtils::readUnsingedInteger($this->file) ,
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
        $details["Delta Table"] = $this->formattedTable();
  

        return $details;
    }
    
    private function formattedTable(){
        $formattedTable = [];
        for($i = 0; $i < $this->entryCount ; $i++){
            $formattedTable[] = $this->deltaTable[$i][0] . " : " . $this->deltaTable[$i][1];
        }
        return $formattedTable;
    }

}