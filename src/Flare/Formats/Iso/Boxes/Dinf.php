<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Description of Smhd
 *
 * @author Brian Parra
 */
class Dinf extends \Flare\Formats\Iso\Box {

    function __construct($file) {

        $this->boxType = \Flare\Formats\Iso\Box::DINF;
        parent::__construct($file);
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
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
        \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size, place holder for now
        \Flare\Common\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }

}
