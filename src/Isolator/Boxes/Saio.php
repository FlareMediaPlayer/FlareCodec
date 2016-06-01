<?php

namespace Isolator\Boxes;

/**
 * Sample Auxiliary Information Offsets
 * @author Brian Parra
 */
class Saio extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SAIO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}