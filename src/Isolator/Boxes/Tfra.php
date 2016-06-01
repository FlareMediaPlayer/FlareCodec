<?php

namespace Isolator\Boxes;

/**
 * Track Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Tfra extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TFRA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}