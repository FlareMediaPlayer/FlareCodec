<?php

namespace Isolator\Boxes;

/**
 * Sample to group
 * @author Brian Parra
 */
class Sbgp extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SBGP;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}