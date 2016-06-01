<?php

namespace Isolator\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Pitm extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::PITM;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}