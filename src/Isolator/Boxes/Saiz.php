<?php

namespace Isolator\Boxes;

/**
 * Sample Auxillary Information Sizes
 * @author Brian Parra
 */
class Saiz extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}