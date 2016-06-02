<?php

namespace Isolator\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Ctts extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::CTTS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}