<?php

namespace Isolator\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Strk extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::STRK;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}