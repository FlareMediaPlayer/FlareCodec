<?php

namespace Flare\Boxes;

/**
 * Description of Stsd
 *
 * @author Brian Parra
 */
class Stco extends \Flare\FullBox {

    private $entryCount;
    private $chunkOffsetTable;

    function __construct($file) {

        $this->boxType = \Flare\Box::STCO;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Flare\ByteUtils::readUnsingedInteger($this->file);
        for ($i = 0; $i < $this->entryCount; $i++) {
            $this->chunkOffsetTable[] = \Flare\ByteUtils::readUnsingedInteger($this->file);
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

    public function getEntryCount() {
        return $this->entryCount;
    }

    public function getChunkOffsetTable() {
        return $this->chunkOffsetTable;
    }

    public function setChunkOffsetTable($chunkOffsetTable) {
        $this->chunkOffsetTable = $chunkOffsetTable;
        $this->entryCount = count($chunkOffsetTable);
    }

    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 12 + 4 + (4 * $this->entryCount); //12 for header + 4 for count + (4+4)* count for entires 
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]);
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]);
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]);


        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount);
        for ($i = 0; $i < $this->entryCount; $i++) {
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->chunkOffsetTable[$i]);
        }
    }

}
