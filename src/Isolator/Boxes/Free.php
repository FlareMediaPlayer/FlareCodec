<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Free extends \Isolator\Box {
    
    private $freeBytes = 0;
    private $data;


    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FREE;
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
