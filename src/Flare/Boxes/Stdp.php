<?php

namespace Flare\Boxes;

/**
 * Sample Degradation Priority
 * @author Brian Parra
 */
class Stdp extends \Flare\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Flare\Box::STDP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}