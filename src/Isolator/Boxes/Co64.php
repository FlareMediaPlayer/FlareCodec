<?php

namespace Isolator\Boxes;

/**
 * 64-bit chunk offset
 * @author Brian Parra
 */
class Co64 extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::CO64;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}