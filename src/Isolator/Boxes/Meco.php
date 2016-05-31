<?php

namespace Isolator\Boxes;

/**
 * Holds Meta Data.
 * Is a top level box.
 * @author Brian Parra
 */
class Meco extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MECO;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}