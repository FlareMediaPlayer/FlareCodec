<?php

namespace Isolator\Boxes;

/**
 * Copyright info
 * @author Brian Parra
 */
class Cprt extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::CPRT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}