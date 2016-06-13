<?php

namespace Isolator\Boxes;

/**
 * Description of Mdia
 *
 * @author Brian Parra
 */
class Mdia extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::MDIA;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
    }

    public function getMinfBox() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Minf) {
                return $box;
            }
        }
        return null;
    }

    public function isAudioTrack() {

        $minf = $this->getMinfBox();
        if ($minf != null) {
            return $minf->isAudioTrack();
        } else {
            return false;
        }
    }
    
    public function writeToFile() {
        $this->prepareForWriting();
        foreach($this->boxMap as $box){
            $box->writeToFile();
        }
        $this->finalizeWriting();
    }
    
    public function prepareForWriting(){
        
        $this->offset = ftell($this->file); //Save the file pointer
        $this->headerSize = 8;
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
    }
    
    public function finalizeWriting(){
        
        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file

    }

}
