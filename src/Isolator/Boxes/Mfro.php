<?php

namespace Isolator\Boxes;

/**
 * Movie Fragment Random Access
 * Is a top level box.
 * @author Brian Parra
 */
class Mfro extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MFRO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}