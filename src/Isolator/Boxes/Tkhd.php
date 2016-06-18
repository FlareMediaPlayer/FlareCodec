<?php

namespace Isolator\Boxes;

/**
 * Description of Tkhd
 *
 * @author Brian Parra
 */
class Tkhd extends \Isolator\FullBox {

    private $creationTime = 0;
    private $modificationTime = 0;
    private $trackID = 0;
    private $duration = 0;
    private $layer = 0;
    private $alternateGroup = 0;
    private $volume = 0;
    private $matrix = [
        65536, 0, 0, 0, 65536, 0, 0, 0, 1073741824
    ]; // Unity Matrix
    private $width = 0;
    private $height = 0;
    private $minf; //cached reference to $minf box

    function __construct($file) {

        $this->boxType = \Isolator\Box::TKHD;
        parent::__construct($file);
    }

    public function loadData() {

        if ($this->largeSize) {

            $this->headerSize = 16; //4 size + 4 type + 8 extended size; 
        } else {

            $this->headerSize = 8; //4 size + 4 type 
        }

        fseek($this->file, $this->offset + $this->headerSize);
        $this->version = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[0] = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[1] = \Isolator\ByteUtils::readUnsignedByte($this->file);
        $this->flags[2] = \Isolator\ByteUtils::readUnsignedByte($this->file);

        if ($this->version == 1) {
            $this->creationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsignedLong($this->file);
            $this->trackID = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            \Isolator\ByteUtils::skipBytes($this->file, 4); //skip 32 bits
            $this->duration = \Isolator\ByteUtils::readUnsignedLong($this->file);
        } else {

            $this->creationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->modificationTime = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            $this->trackID = \Isolator\ByteUtils::readUnsingedInteger($this->file);
            \Isolator\ByteUtils::skipBytes($this->file, 4); //skip 32 bits
            $this->duration = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        }

        \Isolator\ByteUtils::skipBytes($this->file, 8); //skip 64 bits
        $this->layer = \Isolator\ByteUtils::readUnsignedShort($this->file);
        $this->alternateGroup = \Isolator\ByteUtils::readUnsignedShort($this->file);
        $this->volume = \Isolator\ByteUtils::readFixedPoint8_8($this->file);

        \Isolator\ByteUtils::skipBytes($this->file, 2); //skip 16 bits

        $this->readMatrix();
        $this->width = \Isolator\ByteUtils::readFixedPoint16_16($this->file);
        $this->height = \Isolator\ByteUtils::readFixedPoint16_16($this->file);
    }

    public function getBoxDetails() {

        $details = [];

        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Version"] = $this->version;
        $details["Flags"] = [
            "Track Enabled" => $this->flags[0],
            "Track In Movie" => $this->flags[1],
            "Track In Preview" => $this->flags[2]
        ];

        $details["Creation Time"] = $this->creationTime;
        $details["Modification Time"] = $this->modificationTime;
        $details["Track ID"] = $this->trackID;
        $details["Duration"] = $this->duration;
        $details["Layer"] = $this->layer;
        $details["Alternate Group"] = $this->alternateGroup;
        $details["Volume"] = $this->volume;
        $details["Matrix"] = $this->matrix;
        $details["Height"] = $this->height;
        $details["Width"] = $this->width;



        return $details;
    }

    protected function readMatrix() {
        for ($i = 0; $i < 9; $i++) {
            $this->matrix[$i] = \Isolator\ByteUtils::readUnsingedInteger($this->file);
        }
    }

    public function writeToFile() {
        $this->offset = ftell($this->file); //Save the file pointer
        $this->size = 92; //expand if version 1
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->size); //Write the box size place holder for now
        \Isolator\ByteUtils::writeChars($this->file, $this->boxType); //Write the box type

        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->version); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[0]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[1]); //Write the box version
        \Isolator\ByteUtils::writeUnsignedByte($this->file, $this->flags[2]); //Write the box version //12 bytes so far
        //12

        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->creationTime);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->modificationTime);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->trackID);
        \Isolator\ByteUtils::padBytes($this->file, 4);
        \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->duration);
        //32

        \Isolator\ByteUtils::padBytes($this->file, 8);
        \Isolator\ByteUtils::writeUnsignedShort($this->file, $this->layer);
        \Isolator\ByteUtils::writeUnsignedShort($this->file, $this->alternateGroup);
        \Isolator\ByteUtils::writeFixed8_8($this->file, $this->volume);
        \Isolator\ByteUtils::padBytes($this->file, 2);
        //48

        $this->writeMatrix();
        //84

        \Isolator\ByteUtils::writeFixed16_16($this->file, $this->width);
        \Isolator\ByteUtils::writeFixed16_16($this->file, $this->height);
        //92
    }

    public function getTrackID() {
        return $this->trackID;
    }

    protected function writeMatrix() {
        for ($i = 0; $i < 9; $i++) {
            \Isolator\ByteUtils::writeUnsignedInteger($this->file, $this->matrix[$i]);
        }
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function setVolume($volume) {
        $this->volume = $volume;
    }

    public function setTrackID($ID) {
        $this->trackID = $ID;
    }

    public function setAlternateGroup($alternatGroup) {
        $this->alternateGroup = $alternateGroup;
    }

}
