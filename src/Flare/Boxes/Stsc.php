<?php

namespace Flare\Boxes;

/**
 * Description of Stsc
 * Sample To Chunk Box
 * @author Brian Parra
 */
class Stsc extends \Flare\FullBox {

    private $entryCount;
    private $chunkTable;

    function __construct($file) {

        $this->boxType = \Flare\Box::STSC;
        parent::__construct($file);
 
        
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Flare\ByteUtils::readUnsingedInteger($this->file);
        $this->chunkTable = [];
        for($i = 0; $i < $this->entryCount ; $i++){
            $this->chunkTable[$i] =  
                    [
                        \Flare\ByteUtils::readUnsingedInteger($this->file) -1,//first chunk
                        \Flare\ByteUtils::readUnsingedInteger($this->file), //samples per chunk
                        \Flare\ByteUtils::readUnsingedInteger($this->file) //sample description index
                    ];
        }
    }
    
    public function getChunkTable(){
        return $this->chunkTable;
    }
    
    public function setChunkTable($chunkTable){
        $this->chunkTable = $chunkTable;
        $this->entryCount = count($chunkTable);
    }


    public function getChunkTableEntryCount(){
        return $this->entryCount;
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
    
    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 12 + 4 + (12 * $this->entryCount); //12 for header + 4 for count + (4+4)* count for entires 
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); 
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); 
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); 
        
        
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount);
        for($i = 0; $i < $this->entryCount; $i++){
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->chunkTable[$i][0]);
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->chunkTable[$i][1]);
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->chunkTable[$i][2]);
        }
    }

}
