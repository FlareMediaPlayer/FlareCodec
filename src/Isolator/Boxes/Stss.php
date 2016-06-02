<?php

namespace Isolator\Boxes;

/**
 * Sync Sample Table
 * @author Brian Parra
 */
class Stss extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STSS;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}