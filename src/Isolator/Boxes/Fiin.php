<?php

namespace Isolator\Boxes;

/**
 * Primary Item Reference
 * @author Brian Parra
 */
class Fiin extends \Isolator\Box {
    
    

    function __construct($file) {
        
        $this->boxType = \Isolator\Box::FIIN;
        parent::__construct($file);
        
    }
    
    public function loadData() {
        
    }

}