<?php

namespace Isolator\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Trgr extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TRGR;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}