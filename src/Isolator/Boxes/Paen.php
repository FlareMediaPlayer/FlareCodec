<?php

namespace Isolator\Boxes;

/**
 * Partition Entry
 * @author Brian Parra
 */
class Paen extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::PAEN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}