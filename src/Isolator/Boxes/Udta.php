<?php

namespace Isolator\Boxes;

/**
 * User-data
 * Is a top level box.
 * @author Brian Parra
 */
class Udta extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::UDTA;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}