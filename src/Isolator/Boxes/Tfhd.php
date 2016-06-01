<?php

namespace Isolator\Boxes;

/**
 * Movie Extends Header Box
 * @author Brian Parra
 */
class Tfhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TFHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}