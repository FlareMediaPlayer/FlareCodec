<?php

namespace Flare\Boxes;

/**
 * Description of Esds
 *
 * @author Brian Parra
 */
class Esds extends \Flare\FullBox {

    private $EsDescriptor;

    function __construct($file) {

        $this->boxType = \Flare\Box::ESDS;
        parent::__construct($file);
        $this->EsDescriptor = new \Flare\ObjectDescriptors\EsDescriptor($this->file);
    }

    public function loadData() {
        $this->readHeader();
    }

    public function writeToFile() {
        $this->prepareForWriting();
        $this->EsDescriptor->writeToFile();
        $this->finalizeWriting();
    }

    public function prepareForWriting() {

        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 12; //
        \Flare\ByteUtils::writeUnsignedInteger($this->file, 0); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
    }

    public function finalizeWriting() {

        $boxEnd = ftell($this->file); // Save the current position
        $this->size = $boxEnd - $this->offset;
        fseek($this->file, $this->offset); //Reset write pointer to beginning of file
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Overwrite the box size
        fseek($this->file, $boxEnd); //Finally put the file pointer back at the end of the file
    }

}
