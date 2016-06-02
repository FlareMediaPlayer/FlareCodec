<?php

namespace Isolator\Boxes;

/**
 * Composition time to sample
 * @author Brian Parra
 */
class Stz2 extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STZ2;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}