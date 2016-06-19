<?php

namespace Flare\Boxes;

/**
 * Description of Stsd
 *
 * @author Brian Parra
 */
class Stsd extends \Flare\FullBox {

    private $entryCount;

    function __construct($file) {

        $this->boxType = \Flare\Box::STSD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Flare\ByteUtils::readUnsingedInteger($this->file);
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
            if ($box instanceof \Flare\Boxes\SampleEntries\AudioSampleEntry) {
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
        \Flare\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); 
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); 
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]);
        
        $this->entryCount = count($this->boxMap);
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount); //Write the entry count
        
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }

}
