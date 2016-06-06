<?php

namespace Isolator\Boxes;

/**
 * Description of Smhd
 *
 * @author Brian Parra
 */
class Dinf extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::DINF;
        parent::__construct($file);
        
    }
    
    public function loadData() {

        $headerLength = 8;
        $internalOffset = $this->offset + $headerLength;
        $this->loadChildBoxes($internalOffset);
        
    }

}