<?php

namespace Isolator\Boxes;

/**
 * Fire Resevoir
 * @author Brian Parra
 */
class Fire extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FIRE;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}