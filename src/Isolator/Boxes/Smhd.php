<?php

namespace Isolator\Boxes;

/**
 * Description of Smhd
 *
 * @author Brian Parra
 */
class Smhd extends \Isolator\FullBox {

    private $balance;

    function __construct($file) {

        $this->boxType = \Isolator\Box::SMHD;
        parent::__construct($file);
    }

    public function loadData() {
        $this->readHeader();
        $this->balance = \Isolator\ByteUtils::readFixedPoint8_8($this->file);
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

}
