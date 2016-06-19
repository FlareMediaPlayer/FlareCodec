<?php

namespace Flare\Boxes;

/**
 * Description of Stsd
 *
 * @author Brian Parra
 */
class Elst extends \Flare\FullBox {

    private $entryCount = 0;
    private $mediaRateInteger;
    private $mediaRateFraction = 0;
    private $segmentTable; //segmentDuration, mediaTime

    function __construct($file) {

        $this->boxType = \Flare\Box::ELST;
        parent::__construct($file);
        $this->segmentTable = [];
    }

    public function setSegmentTable($table) {
        $this->segmentTable = $table;
        $this->entryCount = count($table);
    }

    public function getSetmentTable() {
        return $this->segmentTable;
    }

    public function getMediaRateInteger() {
        return $this->mediaRateInteger;
    }

    public function getMediaRateFraction() {
        return $this->mediaRateFraction;
    }

    public function setMediaRateInteger($mediaRateInteger) {
        $this->mediaRateInteger = $mediaRateInteger;
    }

    public function loadData() {
        $this->readHeader();
        $this->entryCount = \Flare\ByteUtils::readUnsingedInteger($this->file);
        for ($i = 0; $i < $this->entryCount; $i++) {
            $this->segmentTable[$i]["segmentDuration"] = \Flare\ByteUtils::readUnsingedInteger($this->file);
            $this->segmentTable[$i]["mediaTime"] = \Flare\ByteUtils::readUnsingedInteger($this->file);
        }
        $this->mediaRateInteger = \Flare\ByteUtils::readUnsignedShort($this->file);
        $this->mediaRateFraction = \Flare\ByteUtils::readUnsignedShort($this->file);
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = $this->flags;
        $details["Entry Count"] = $this->entryCount;
        $details["Media Rate Integer"] = $this->mediaRateInteger;
        $details["Media Rate Fraction"] = $this->mediaRateFraction;

        return $details;
    }

    public function writeToFile() {

        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 20 + (8 * $this->entryCount); //expand if version 1
        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Flare\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Flare\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far

        \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->entryCount);

        for ($i = 0; $i < $this->entryCount; $i++) {

            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->segmentTable[$i]["segmentDuration"]);
            \Flare\ByteUtils::writeUnsignedInteger($this->file, $this->segmentTable[$i]["mediaTime"]);
        }
        
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->mediaRateInteger);
        \Flare\ByteUtils::writeUnsignedShort($this->file, $this->mediaRateFraction);
    }

}
