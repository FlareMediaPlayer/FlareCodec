<?php

namespace Flare\Formats\Iso\Boxes;

/**
 * Description of Smhd
 *
 * @author Brian Parra
 */
class Smhd extends \Flare\Formats\Iso\FullBox {

    private $balance = 0.0;

    function __construct($file) {

        $this->boxType = \Flare\Formats\Iso\Box::SMHD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $this->balance = \Flare\Common\ByteUtils::readFixedPoint8_8($this->file);
    }

    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;

        $details["Balance"] = $this->balance;


        return $details;
    }

    public function writeToFile() {
        
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 16; //its fixed to 16 bits no matter what
        \Flare\Common\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\Common\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type
        
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Flare\Common\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        
        \Flare\Common\ByteUtils::writeFixed8_8($this->file, $this->balance);
        \Flare\Common\ByteUtils::padBytes($this->file, 2);
        
    }
}
