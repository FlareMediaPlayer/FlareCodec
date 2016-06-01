<?php

namespace Isolator\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Trun extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TRUN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}