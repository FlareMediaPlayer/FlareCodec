<?php

namespace Isolator\Boxes;

/**
 * Movie Fragment Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Moof extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MOOF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}