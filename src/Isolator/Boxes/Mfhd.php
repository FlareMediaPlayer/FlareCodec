<?php

namespace Isolator\Boxes;

/**
 * Movie Fragment Header
 * Is a top level box.
 * @author Brian Parra
 */
class Mfhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}