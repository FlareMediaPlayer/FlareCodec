<?php

namespace Flare\Boxes;

/**
 * Skip box, free space.
 * Is a top level box.
 * @author Brian Parra
 */

class Skip extends \Flare\Box {

    private $freeBytes = 0;
    private $data;
    
    function __construct($file) {

        $this->boxType = \Flare\Box::SKIP;
        parent::__construct($file);
    }

    public function loadData() {

        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }

        $this->freeBytes = $this->size - $this->headerSize;
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Free Bytes"] = $this->freeBytes;

        return $details;
    }

}
