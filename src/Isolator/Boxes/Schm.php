<?php

namespace Isolator\Boxes;

/**
 * Scheme Type Box
 * @author Brian Parra
 */
class Schm extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SCHM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}
