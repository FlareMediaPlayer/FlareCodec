<?php

namespace Isolator\Boxes;

/**
 * Sample Degradation Priority
 * @author Brian Parra
 */
class Stdp extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STDP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}