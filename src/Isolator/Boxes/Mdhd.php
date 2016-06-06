<?php

namespace Isolator\Boxes;

/**
 * Description of Mhd
 *
 * @author Brian Parra
 */
class Mdhd extends \Isolator\FullBox {

    private $creationTime;
    private $modificationTime;
    private $timescale;
    private $duration;
    private $language = [];

    function __construct($file) {

        $this->boxType = \Isolator\Box::MDHD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $internalOffset = $this->offset + $this->headerSize;
        if ($this->version == 1) {
            $this->creationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->timescale= \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsignedLong($this->file);
        } else {

            $this->creationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->timescale= \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->duration = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        }
        $langTemp = \Isolator\ByteUtils::readBytesAsHex($this->file, 2);
        var_dump($langTemp);
        
    }

    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Creation Time"] = $this->creationTime;
        $details["Modification Time"] = $this->modificationTime;
        $details["Time Scale"] = $this->timescale;
        $details["Duration"] = $this->duration;
        $details["Language"] = "Finish later";


        return $details;
    }

}
