<?php

namespace Isolator\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Mehd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::MEHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}