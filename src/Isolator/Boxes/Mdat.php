<?php

namespace Isolator\Boxes;

/**
 * Description of FREE
 *
 * @author mac
 */
class Mdat extends \Isolator\Box {
    
    private $data;
    private $dataBytes;
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MDAT;
        parent::__construct($file);
        
    }
    
    public function loadData() {

        if ($this->largeSize) {
            $this->headerSize = 16; //4 size + 4 type + 8 extended size;
        } else {
            $this->headerSize = 8; //4 size + 4 type 
        }

        $this->dataBytes = $this->size - $this->headerSize;
    }

    public function getBoxDetails() {
        $details = [];
        $details["Size"] = $this->size;
        $details["Offset"] = $this->offset;
        $details["Data Bytes"] = $this->dataBytes;

        return $details;
    }

}