<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Description of Stsd
 * Time To Sample Box
 * @author Brian Parra
 */
class Stts extends \Flare\Formats\Iso\FullBox {
    
    private $entryCount;
    private $deltaTable;

    function __construct($file) {
        
        $this->boxType = \Flare\Formats\Iso\Box::STTS;
        parent::__construct($file);
        //$this->deltaTable = [][];
        
    }
    
    public function loadData() {
        
        $this->readHeader();
        $this->entryCount = \Flare\Common\ByteUtils::readUnsingedInteger($this->file);
        $this->deltaTable = [];
        for($i = 0; $i < $this->entryCount ; $i++){
            $this->deltaTable[$i] =  
                    [
                        \Flare\Common\ByteUtils::readUnsingedInteger($this->file) ,
                        \Flare\Common\ByteUtils::readUnsingedInteger($this->file)
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

    public function setDeltaTable($deltaTable){
   
        $this->deltaTable = $deltaTable;
        $this->entryCount = count($deltaTable);
    }
    
    public function getDeltaTable(){
        return $this->deltaTable;
    }


    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 12 + 4 + (8 * $this->entryCount); //12 for header + 4 for count + (4+4)* count for entires 
        \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\Common\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); 
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); 
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); 
        
        
        \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount);
        for($i = 0; $i < $this->entryCount; $i++){
            \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->deltaTable[$i][0]);
            \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->deltaTable[$i][1]);
        }
    }
}