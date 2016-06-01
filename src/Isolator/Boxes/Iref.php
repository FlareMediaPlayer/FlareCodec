<?php

namespace Isolator\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Iref extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::IREF;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}