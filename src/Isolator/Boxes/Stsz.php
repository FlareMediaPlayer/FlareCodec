<?php

namespace Isolator\Boxes;

/**
 * Description of Stsz
 *
 * @author Brian Parra
 */
class Stsz extends \Isolator\FullBox {

    private $sampleSize = 0;
    private $sampleCount;
    private $sampleSizeTable;

    function __construct($file) {

        $this->boxType = \Isolator\Box::STSZ;
        parent::__construct($file);
    }

    public function loadData() {

        $this->readHeader();
        $this->sampleSize = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        if ($this->sampleSize == 0) {
            $this->sampleCount = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            for ($i = 0; $i < $this->sampleCount; $i++) {
                $this->sampleSizeTable[] = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            }
        }
    }

    public function getSampleSizeTable() {
        return $this->sampleSizeTable;
    }

    public function setSampleSizeTable($sampleSizeTable) {
        $this->sampleSizeTable = $sampleSizeTable;
        $this->sampleCount = count($sampleSizeTable);
        if ($this->sampleCount > 1) {
            $this->sampleSize = 0;
        } else {
            $this->sampleSize = $this->sampleSizeTable[0];
        }
    }

    public function getSampleCount() {
        return $this->sampleCount;
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

    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 12 + 4; //12 for header + 4 for count + (4+4)* count for entires 
        if ($this->sampleSize == 0) {
            $this->size += 4 + (4 * $this->sampleCount);
        }
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]);
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]);
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]);

        
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->sampleSize);
        
        if ($this->sampleSize == 0) {
            \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->sampleCount);
            for ($i = 0; $i < $this->sampleCount; $i++) {
                \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->sampleSizeTable[$i]);
            }
        }
    }

}
