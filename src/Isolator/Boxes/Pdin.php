<?php

namespace Isolator\Boxes;

/**
 * Progressive Download Information Box.
 * Is a top level box.
 * @author Brian Parra
 */
class Pdin extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::PDIN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}