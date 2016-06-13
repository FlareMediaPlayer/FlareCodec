<?php

namespace Isolator\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Trak extends \Isolator\Box {

    private $mdia; //cache a direct reference to the Mdia media header box

    function __construct($file) {

        $this->boxType = \Isolator\Box::TRAK;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
    }

    public function isAudioTrack() {
        $mdia = $this->getMdiaBox();
        if ($mdia != null) {
            return $mdia->isAudioTrack();
        } else {
            return false;
        }
    }

    public function getMdiaBox() {
        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Mdia) {
                return $box;
            }
        }
        return null;
    }

    public function getTrackID() {

        foreach ($this->boxMap as $box) {
            if ($box instanceof \Isolator\Boxes\Tkhd) {
                return $box->getTrackID();
            }
        }
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
