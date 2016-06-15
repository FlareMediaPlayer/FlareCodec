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
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]);
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]);
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]);


        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount);
        for ($i = 0; $i < $this->entryCount; $i++) {
            \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->chunkOffsetTable[$i][0]);
        }
    }

}
