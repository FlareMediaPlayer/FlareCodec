<?php

namespace Isolator\Boxes;

/**
 * Movie Extends Box
 * Is a top level box.
 * @author Brian Parra
 */
class Mvex extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MVEX;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}