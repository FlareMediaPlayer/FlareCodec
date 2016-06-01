<?php

namespace Isolator\Boxes;

/**
 * Track Reference Container
 * @author Brian Parra
 */
class Tref extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}