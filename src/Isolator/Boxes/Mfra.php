<?php

namespace Isolator\Boxes;

/**
 * Movie Fragment Random Access box.
 * Is a top level box.
 * @author Brian Parra
 */
class Mfra extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}