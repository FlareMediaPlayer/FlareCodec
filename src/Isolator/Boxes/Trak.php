<?php

namespace Isolator\Boxes;

/**
 * Description of Mvhd
 *
 * @author Brian Parra
 */
class Trak extends \Isolator\Box {

    function __construct($file) {

        $this->boxType = \Isolator\Box::TRAK;
        parent::__construct($file);
        
    }

    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
        
        
    }

    public function getTrackID(){
        
        foreach($this->boxMap as $box){
            if($box instanceof \Isolator\Boxes\Tkhd){
                return $box->getTrackID();
            }
        }
        
    }

}
