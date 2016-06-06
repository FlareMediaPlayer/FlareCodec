<?php

namespace Isolator\Boxes;

/**
 * Description of Mdia
 *
 * @author Brian Parra
 */
class Mdia extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MDIA;
        parent::__construct($file);
        
    }
    
    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
        
    }

}