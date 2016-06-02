<?php

namespace Isolator\Boxes;

/**
 * Composition to decode timeline mapping
 * @author Brian Parra
 */
class Cslg extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::CSLG;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}