<?php

namespace Isolator\Boxes;

/**
 * Description of Stsd
 *
 * @author Brian Parra
 */
class Stco extends \Isolator\FullBox {

    private $entryCount;
    private $chunkOffsetTable;

    function __construct($file) {

        $this->boxType = \Isolator\Box::STCO;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        for ($i = 0; $i < $this->entryCount; $i++) {
            $this->chunkOffsetTable[] = \Isolator\ByteUtils::readUnsingedInteger($this->file);
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
    
    public function getEntryCount(){
        return $this->entryCount;
    }

    public function getChunkOffsetTable(){
        return $this->chunkOffsetTable;
    }
}
