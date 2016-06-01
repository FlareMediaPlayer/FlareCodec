<?php

namespace Isolator\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Leva extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::LEVA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}