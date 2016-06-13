<?php

namespace Isolator\Boxes;

/**
 * Description of Minf
 *
 * @author Brian Parra
 */
class Minf extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::MINF;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
    }

    public function getStblBox() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Stbl) {
                return $box;
            }
        }
        return null;
    }

    public function isAudioTrack() {
        return $this->getStblBox()->isAudioTrack();
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
        $this->headerSize = 8;
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }

}
