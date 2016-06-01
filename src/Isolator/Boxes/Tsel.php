<?php

namespace Isolator\Boxes;

/**
 * Track Grouping Indication
 * @author Brian Parra
 */
class Tsel extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::TSEL;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}