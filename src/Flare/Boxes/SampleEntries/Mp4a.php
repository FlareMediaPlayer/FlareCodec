<?php

namespace Flare\Boxes\SampleEntries;

/**
 * Description of Mp4a
 *
 * @author Brian Parra
 */
class Mp4a extends \Flare\Boxes\SampleEntries\AudioSampleEntry {

  
    private $esdBox;

    function __construct($file) {

        $this->boxType = \Flare\Box::MP4A;
        parent::__construct($file);
    }

    public function loadData() {
        parent::loadData();
    }

    public function getBoxDetails() {

        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Data Reference Index"] = $this->dataReferenceIndex;
        $details["Channel Count"] = $this->channelCount;
        $details["Sample Size"] = $this->sampleSize;
        $details["Sample Rate"] = $this->sampleRate;




        return $details;
    }

    public function writeToFile() {
        $this->prepareForWriting();
        foreach ($this->boxMap as $box) {
            $box->writeToFile();
        }
        $this->finalizeWriting();
    }

    public function prepareForWriting() {
        //var_dump($this->dataReferenceIndex);
        $this->offset = ftell($this->file); //Save the file pointer
        \Flare\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        //From Sample Entry
        \Flare\ByteUtils::padBytes($this->file, 6);
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->dataReferenceIndex);
        
        //From Audio Sample Entry
        \Flare\ByteUtils::padBytes($this->file, 8);
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->channelCount);
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->sampleSize);
        \Flare\ByteUtils::padBytes($this->file, 2);
        \Flare\ByteUtils::padBytes($this->file, 2);
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->sampleRate);//pg 161 is wrong its short and the second 2 bits aren't used
        \Flare\ByteUtils::padBytes($this->file, 2);
        //Continue with the rest of the boxes, channel layout should be first
        
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }
    
    public function setSampleRate($sampleRate){
        $this->sampleRate = $sampleRate;
    }

}
