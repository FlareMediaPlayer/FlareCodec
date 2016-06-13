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

    public function isAudioTrack() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\SampleEntries\AudioSampleEntry) {
                return true;
            }
        }
        return false;
    }

    public function writeToFile() {
        $this->prepareForWriting();
        foreach ($this->boxMap as $box) {
            $box->writeToFile();
        }
        $this->finalizeWriting();
    }

    public function prepareForWriting() {

        $this->offset = ftell($this->file); //Save the file pointer
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); 
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); 
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]);
        
        $this->entryCount = count($this->boxMap);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount); //Write the entry count
        
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }

}
