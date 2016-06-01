<?php

namespace Isolator\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Segr extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::SEGR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}