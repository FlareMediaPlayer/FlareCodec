<?php

namespace Isolator\Boxes;

/**
 * Sample Padding Bits
 * @author Brian Parra
 */
class Padb extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::PADB;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}