<?php

namespace Isolator\Boxes;

/**
 * Track Fragment.
 * Is a top level box.
 * @author Brian Parra
 */
class Traf extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TRAF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}