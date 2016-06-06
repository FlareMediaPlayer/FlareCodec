<?php

namespace Isolator\Boxes;

/**
 * Urn
 * @author Brian Parra
 */
class Urn extends \Isolator\FullBox {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::URN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}