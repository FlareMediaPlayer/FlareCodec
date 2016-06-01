<?php

namespace Isolator\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Tfdt extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TFDT;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}