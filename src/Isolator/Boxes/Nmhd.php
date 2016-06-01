<?php

namespace Isolator\Boxes;

/**
 * Null Media Header
 * @author Brian Parra
 */
class Nmhd extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::NMHD;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}