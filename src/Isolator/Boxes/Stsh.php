<?php

namespace Isolator\Boxes;

/**
 * Shadow Sync Sample Table
 * @author Brian Parra
 */
class Stsh extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STSH;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }
    

}